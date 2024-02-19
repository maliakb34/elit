<?php

namespace AiBuddy;

use AiBuddy\OpenAi\Api;
use AiBuddy\OpenAi\ImageQuery;
use AiBuddy\OpenAi\Query;
use AiBuddy\OpenAi\Response;
use AiBuddy\OpenAi\TextQuery;
use AiBuddy\OpenAi\MessageQuery;
use Exception;
use InvalidArgumentException;
use RuntimeException;

class AiContentGenerator {
	private Api $api;

	public function __construct( Api $api ) {
		$this->api = $api;
	}

	/**
	 * @return Response
	 */
	public function exec( Query $query ) {
		try {
			if ( $query instanceof TextQuery ) {
				$data     = $this->api->create_completions( $query->to_request_body() );
				$response = new Response(
					$query,
					! is_string( $data ) ? $data['choices'] : array( $data ),
					! is_string( $data ) ? $data : array( $data ),
				);

			} elseif ( $query instanceof ImageQuery ) {
				$data     = $this->api->create_images( $query->to_request_body() );
				$response = new Response(
					$query,
					! is_string( $data ) ? array_column( $data['data'], 'url' ) : array( $data ),
					! is_string( $data ) ? $data : array( $data ),
				);
			} elseif ( $query instanceof MessageQuery ) {
				$data     = $this->api->create_message_completions( $query->to_request_body() );
				$response = new Response(
					$query,
					$data['choices'][0]['message'],
					$data
				);
			} else {
				throw new InvalidArgumentException( 'Unknown query type' );
			}
			UsageLogger::log( $response );
			return $response;
		} catch ( Exception $e ) {
			throw new RuntimeException( $e->getMessage() );
		}
	}
}
