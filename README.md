# Woo Test Helper

This is a helper plugin to set upo and tear down certain WooCommerce settings within an e2e environment.

Quick links: [Installing](#installing) | [Usage](#usage) | [Contributing](#contributing)

## Installing

This plugin can either be installed manually, bydownloading it, uploading it via WP Admin » Plugins and the activating it.

Besides that, It can also be automatically installed in an `wp-env` environment using teh following `.wp-env.json` configuration:

```json
"plugins": [
    "https://github.com/nielslange/woo-test-helper/archive/master.zip",
    "."
],
```

## Usage

To set up the Terms & Conditions and Privacy Policy pages, add the following parameter to the URL of your e2e environment:

```
?setup_terms_and_privacy
```

To tear down the Terms & Conditions and Privacy Policy pages, add the following parameter to the URL of your e2e environment:

```
?teardown_terms_and_privacy
```

## Contributing

Contributions are always welcome! Feel free to create a new [issue](https://github.com/nielslange/woo-test-helper/issues) or [pull request](https://github.com/nielslange/woo-test-helper/pulls).
