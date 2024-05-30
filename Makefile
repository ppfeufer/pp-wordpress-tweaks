# Makefile for the WordPress plugin WordPress Tweaks

# Default goal and help message for the Makefile
.DEFAULT_GOAL := help

# Plugin name and slug
plugin_name = WordPress Tweaks
plugin_slug = pp-wordpress-tweaks

# Help message for the Makefile
help::
	@echo "$(FONT_BOLD)$(plugin_name)$(FONT_BOLD_END) Makefile"
	@echo ""
	@echo "$(FONT_BOLD)Usage:$(FONT_BOLD_END)"
	@echo "  make [command]"
	@echo ""
	@echo "$(FONT_BOLD)Commands:$(FONT_BOLD_END)"

# Include the configurations
include .make/conf.d/*.mk
