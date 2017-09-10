[![Latest Stable Version](https://poser.pugx.org/xgc/code-prettify-bundle/v/stable)](https://packagist.org/packages/xgc/code-prettify-bundle)
[![License](https://poser.pugx.org/xgc/code-prettify-bundle/license)](https://packagist.org/packages/xgc/code-prettify-bundle)
[![Downloads](https://poser.pugx.org/xgc/code-prettify-bundle/downloads)](https://packagist.org/packages/xgc/code-prettify-bundle)
[![Build Status](https://travis-ci.org/xgc1986/prettify-bundle.svg?branch=master)](https://travis-ci.org/xgc1986/prettify-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xgc1986/prettify-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xgc1986/prettify-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xgc1986/prettify-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xgc1986/prettify-bundle/?branch=master)

# Code Prettify Bundle

A Syntax Higlighter for twig

## Installation

```bash
$ composer require xgc/code-prettify-bundle
```

## Usage

[Online](http://xgc-samples.herokuapp.com)

```yaml
xgc_assetics:
    
  my_assetic_collection:
    - 'dependency1'
    - 'http://example.com/file.js'
    - 'http://example.com/file.css'
    
  dependency1:
    - 'http://example.com/dependant.js'
```

```twig
<html>
<head>
    {{ xgc_assetics('my_assetic_collection') }}
</head>
<body>...</body>
</html>
```
