<?php

    require_once('../classes/tableGenerator.class.php');

    $css = <<<EOF
<style>
table, th, td {
    border: 1px solid black;
}

.firstRow
{
    background-color: lightgray;
}

#fifthCell
{
    background-color: lightyellow;
}

</style>
EOF;

    echo $css;

    $cell1 = new Cell('Cell 1 Content');
    $cell1->addScope('col');

    $cell2 = new Cell('Cell 2 Content');
    $cell2->addScope('col');

    $row1 = new Row(array($cell1, $cell2));
    $row1->class = 'firstRow';

    $cell3 = new Cell('Cell 3 Content');
    $cell4 = new Cell('Cell 4 Content');
    $cell4->style = 'background-color: lightblue;';

    $row2 = new Row(array($cell3));
    $row2->addCell($cell2, 0);

    $cell5 = new Cell('Cell 5 Content');
    $cell5->id = 'fifthCell';

    $cell6 = new Cell('Cell 6 Content');

    $row3 = new Row(array($cell5, $cell6));

    $head = new Head($row1);
    $head->addData(array('myData', 'myDataValue'));

    $body = new Body(array($row2, $row3));

    $table = new Table();

    $table->addHead($head);
    $table->addBody($body);

    $table->display();