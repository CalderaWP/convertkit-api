# ConvertKit API
WordPress API client for ConvertKit API v3

This library was developed for use in our [ConvertKit for Caldera Forms plugin](https://calderawp.com/downloads/convertkit-caldera-forms/). It is provided here for other developers to use to build their own intergrations.

For full API docs, see [http://kb.convertkit.com/article/api-documentation-v3/](http://kb.convertkit.com/article/api-documentation-v3/)

Requires PHP 5.3 or later.

# Installation

`composer require calderawp/convertkit-api`

# Examples

## Get all forms:
```
    use calderawp\convertKit\forms;

	$client = new forms( $api_key );
	$forms = $client->get_all();
```

## Get all sequences:
```
    use calderawp\convertKit\sequences;
    
	$client = new sequences( $api_key );
	$sequences = $client->get_all();
```

## Add a subscriber to a form:

```
    use calderawp\convertKit\forms
    
    
    $name = 'Hi Roy';
    $client = new forms( $api_key );
    $form = $client->get( $name );
    if( $form ) {
        $client->add( $form->id, [ 'email' => 'roy@roysivan.com' ] );
    
    }
    
```
    
## Add a subscriber to a sequence:

```
    use calderawp\convertKit\sequences;
    
    $name = 'Hi Roy';
    $client = new forms( $api_key );
    $sequence = $client->get( $name );
    if( $sequence ) {
        $client->add( $sequence->id, [ 'email' => 'roy@roysivan.com' ] );
    
    }
    
```


# License, Copyright, Etc.
Copyright 2016 Josh Pollock for CalderaWP LLC. License under the terms of the GPL v2 or later. Some copypasta from https://github.com/ConvertKit/ConvertKit-WordPress/blob/master/lib/convertkit-api.php which is GPL :)
