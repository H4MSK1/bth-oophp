<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


$app->router->get('filter', function () use ($app) {
    $text = <<<EOD
Först lite vanlig text följt av en tom rad.

Då tar vi ett nytt stycke med lite bbcode med [b]bold[/b] och [i]italic[/i] samt en [url=https://dbwebb.se]länk till dbwebb[/url].

Sen testar vi en länk till https://dbwebb.se som skall bli klickbar.

Avslutningsvis blir det en [länk skriven i markdown](https://dbwebb.se) och länken leder till dbwebb.

Avsluter med en lista som formatteras till ul/li med markdown.

* Item 1
* Item 2
EOD;

    $filter = new \H4MSK1\Filter\TextFilter();
    $data = [
        'text' => $filter->parse($text, ['bbcode', 'markdown', 'link']),
        'title' => 'Test filters'
    ];

    $app->view->add('anax/v2/filter/index', $data);

    return $app->page->render([
        'title' => $data['title'],
    ]);
});
