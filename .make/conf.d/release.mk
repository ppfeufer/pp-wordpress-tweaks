# Create a new release archive and upload to the Qbus WP release server
release-archive:
	@echo "Creating a new release archive …"
	@rm -f $(plugin_slug).zip
	@rm -rf $(plugin_slug)/
	@rsync \
		-ax \
		--exclude-from=.make/rsync-exclude.lst \
		. \
		$(plugin_slug)/
	@zip \
		-r \
		$(plugin_slug).zip \
		$(plugin_slug)/
	@rm -rf $(plugin_slug)/

help::
	@echo "  $(FONT_UNDERLINE)Release:$(FONT_UNDERLINE_END)"
	@echo "    release-archive           Create a new release archive and upload to the Qbus WP release server."
	@echo "                              The release archive ($(plugin_slug).zip) will be created in the root"
	@echo "                              directory of the plugin."
	@echo ""
