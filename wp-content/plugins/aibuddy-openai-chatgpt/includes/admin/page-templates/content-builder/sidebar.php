<div class="section">
	<div class="section-title"><?php echo esc_html__( 'Options of content', 'aibuddy-openai-chatgpt' ); ?></div>
	<div class="section-content content-params">
		<div class="section-field">
			<div class="check-box">
				<input type="checkbox" class="checkbox" id="check-bulk-content" />
				<label for="check-bulk-content"></label>
				<span class="checkbox-text"><?php echo esc_html__( 'Bulk content builder', 'aibuddy-openai-chatgpt' ); ?></span>
			</div>
		</div>
		<div class="section-subtitle"><span><?php echo esc_html__( 'Language of the text', 'aibuddy-openai-chatgpt' ); ?>:</span></div>
		<select id="select-language" class="ai-buddy-select">
			<option value="Arabic"><?php echo esc_html__( 'Arabic', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Bulgarian"><?php echo esc_html__( 'Bulgarian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Chinese"><?php echo esc_html__( 'Chinese', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Croatian"><?php echo esc_html__( 'Croatian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Czech"><?php echo esc_html__( 'Czech', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Danish"><?php echo esc_html__( 'Danish', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Dutch"><?php echo esc_html__( 'Dutch', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="English" selected><?php echo esc_html__( 'English', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Estonian"><?php echo esc_html__( 'Estonian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Filipino"><?php echo esc_html__( 'Filipino', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Finnish"><?php echo esc_html__( 'Finnish', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="French"><?php echo esc_html__( 'French', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="German"><?php echo esc_html__( 'German', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Greek"><?php echo esc_html__( 'Greek', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Hebrew"><?php echo esc_html__( 'Hebrew', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Hindi"><?php echo esc_html__( 'Hindi', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Hungarian"><?php echo esc_html__( 'Hungarian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Indonesian"><?php echo esc_html__( 'Indonesian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Italian"><?php echo esc_html__( 'Italian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Indonesian"><?php echo esc_html__( 'Indonesian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Japanese"><?php echo esc_html__( 'Japanese', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Korean"><?php echo esc_html__( 'Korean', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Latvian"><?php echo esc_html__( 'Latvian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Lithuanian"><?php echo esc_html__( 'Lithuanian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Malay"><?php echo esc_html__( 'Malay', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Norwegian"><?php echo esc_html__( 'Norwegian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Polish"><?php echo esc_html__( 'Polish', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Portuguese"><?php echo esc_html__( 'Portuguese', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Romanian"><?php echo esc_html__( 'Romanian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Russian"><?php echo esc_html__( 'Russian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Serbian"><?php echo esc_html__( 'Serbian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Slovak"><?php echo esc_html__( 'Slovak', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Serbian"><?php echo esc_html__( 'Serbian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Slovenian"><?php echo esc_html__( 'Slovenian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Spanish"><?php echo esc_html__( 'Spanish', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Swedish"><?php echo esc_html__( 'Swedish', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Thai"><?php echo esc_html__( 'Thai', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Turkish"><?php echo esc_html__( 'Turkish', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Ukrainian"><?php echo esc_html__( 'Ukrainian', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Vietnamese"><?php echo esc_html__( 'Vietnamese', 'aibuddy-openai-chatgpt' ); ?></option>
		</select>
		<div class="section-subtitle"><span><?php echo esc_html__( 'Writing style', 'aibuddy-openai-chatgpt' ); ?>:</span></div>
		<select id="select-style" class="ai-buddy-select">
			<option value="Descriptive" selected><?php echo esc_html__( 'Descriptive', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Informative"><?php echo esc_html__( 'Informative', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Creative"><?php echo esc_html__( 'Creative', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Narrative"><?php echo esc_html__( 'Narrative', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Persuasive"><?php echo esc_html__( 'Persuasive', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Reflective"><?php echo esc_html__( 'Reflective', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Argumentative"><?php echo esc_html__( 'Argumentative', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Analytical"><?php echo esc_html__( 'Analytical', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Journalistic"><?php echo esc_html__( 'Journalistic', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Technical"><?php echo esc_html__( 'Technical', 'aibuddy-openai-chatgpt' ); ?></option>
		</select>
		<div class="section-subtitle"><span><?php echo esc_html__( 'Writing tone', 'aibuddy-openai-chatgpt' ); ?>:</span></div>
		<select id="select-tone" class="ai-buddy-select">
			<option value="Neutral" selected><?php echo esc_html__( 'Neutral', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Formal"><?php echo esc_html__( 'Formal', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Assertive"><?php echo esc_html__( 'Assertive', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Cheerful"><?php echo esc_html__( 'Cheerful', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Humorous"><?php echo esc_html__( 'Humorous', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Informal"><?php echo esc_html__( 'Informal', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Inspirational"><?php echo esc_html__( 'Inspirational', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Professional"><?php echo esc_html__( 'Professional', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Coincidental"><?php echo esc_html__( 'Coincidental', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Emotional"><?php echo esc_html__( 'Emotional', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Persuasive"><?php echo esc_html__( 'Persuasive', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Supportive"><?php echo esc_html__( 'Supportive', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Sarcastic"><?php echo esc_html__( 'Sarcastic', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Condescending"><?php echo esc_html__( 'Condescending', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Skeptical"><?php echo esc_html__( 'Skeptical', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Narrative"><?php echo esc_html__( 'Narrative', 'aibuddy-openai-chatgpt' ); ?></option>
			<option value="Journalistic"><?php echo esc_html__( 'Journalistic', 'aibuddy-openai-chatgpt' ); ?></option>
		</select>
		<div class="section-button-box section-button-box-full">
			<button type="button" class="ai-buddy-button gray button-model-params"><?php echo esc_html__( 'Model options', 'aibuddy-openai-chatgpt' ); ?></button>
			<button class="ai-buddy-button gray button-model-prompts right-alignment"><?php echo esc_html__( 'Prompts', 'aibuddy-openai-chatgpt' ); ?></button>
		</div>
	</div>
</div>
