# Variables for the WordPress CLI and the path to the WordPress installation
wp_cli = vendor/bin/wp
wp_path = ./../../../../WP-Sources

# Activate the plugin
.PHONY: activate
activate:
	@echo "Activating the plugin …"
	@$(wp_cli) plugin activate \
		$(plugin_slug) \
		--path=$(wp_path)

# Clear all transient caches
.PHONY: clear-transient
clear-transient:
	@echo "Clearing all transient caches …"
	@$(wp_cli) transient delete \
		--all \
		--path=$(wp_path)

# Deactivate the plugin
.PHONY: deactivate
deactivate:
	@echo "Deactivating the plugin …"
	@$(wp_cli) plugin deactivate \
		$(plugin_slug) \
		--path=$(wp_path)

# Create the plugin .pot file
.PHONY: pot
pot:
	@echo "Creating the plugin .pot file …"
	@$(wp_cli) i18n make-pot \
		. \
		l10n/$(plugin_slug).pot \
		--slug=$(plugin_slug) \
		--domain=$(plugin_slug) \
		--headers='{"Report-Msgid-Bugs-To":"$(plugin_issues_url)"}' \
		--include="/"

# Start the WP-CLI shell
.PHONY: shell
shell:
	@echo "Starting the WP-CLI shell …"
	@$(wp_cli) shell \
		--path=$(wp_path)

# Help message for the WP-CLI commands
.PHONY: help
help::
	@echo "  $(TEXT_UNDERLINE)WP-CLI:$(TEXT_UNDERLINE_END)"
	@echo "    activate                  Activate the plugin"
	@echo "    clear-transient           Clear all transient caches"
	@echo "    deactivate                Deactivate the plugin"
	@echo "    pot                       Create the plugin .pot file"
	@echo "    shell                     Start the WP-CLI shell."
	@echo ""
