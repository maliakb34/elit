<div class="section">
	<div class="section-title"><?php echo esc_html__( 'Model options', 'aibuddy-openai-chatgpt' ); ?></div>
	<div class="section-content">
		<div class="section-field inputs-section">
			<div class="playground-setting-wrapper">
				<span class="section-subtitle"><span><?php echo esc_html__( 'Model:', 'aibuddy-openai-chatgpt' ); ?></span></span>
				<input type="text" name="playground-model" id="playground-model" value="gpt-3.5-turbo" disabled>
			</div>
			<div class="playground-setting-wrapper">
				<span class="section-subtitle"><span><?php echo esc_html__( 'Temperature:', 'aibuddy-openai-chatgpt' ); ?></span></span>
				<input type="number" name="playground-temperature" id="playground-temperature" value="0.6" min="0.1" max="1" step="0.1">
			</div>
			<div class="section-field-information">
				<span class="aibuddy-information"></span> <?php echo esc_html__( 'Between 0.1 and 1. Higher values means the model will take more risks.', 'aibuddy-openai-chatgpt' ); ?>
			</div>
			<div class="playground-setting-wrapper">
				<span class="section-subtitle"><span><?php echo esc_html__( 'Max Tokens:', 'aibuddy-openai-chatgpt' ); ?></span></span>
				<input type="number" name="playground-max-tokens" id="playground-max-tokens" value="2048" min="16" max="2048">
			</div>
			<div class="section-field-information">
				<span class="aibuddy-information"></span> <?php echo esc_html__( 'Between 16 and 2048. Higher values means the model will generate more content.', 'aibuddy-openai-chatgpt' ); ?>
			</div>
		</div>
	</div>
</div>
