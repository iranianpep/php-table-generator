<?php

    use TableGenerator\Body;
    use TableGenerator\Caption;
    use TableGenerator\Cell;
    use TableGenerator\Footer;
    use TableGenerator\Head;
    use TableGenerator\Row;
    use TableGenerator\Table;

    require '../vendor/autoload.php';

$css = <<<'EOF'
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

$row1 = new Row([$cell1, $cell2]);
$row1->class = 'firstRow';

$cell3 = new Cell('Cell 3 Content');
$cell3->addRowspan(2);

$cell4 = new Cell('Cell 4 Content');
$cell4->style = 'background-color: lightblue;';

$row2 = new Row([$cell3, $cell4]);

$cell5 = new Cell('Cell 5 Content');
$cell5->id = 'fifthCell';

$row3 = new Row([$cell5]);

$cell6 = new Cell('Cell 6 Content');
$cell6->addColspan(2);

$row4 = new Row([$cell6]);

$cell7 = new Cell('Cell 7 Content');
$cell8 = new Cell('Cell 8 Content');

$row5 = new Row([$cell7, $cell8]);
$footer = new Footer($row5);

$caption = new Caption('This is caption content');
$caption->class = 'captionClass';
$caption->addData(['captionData', 'captionDataValue']);

$head = new Head($row1);
$head->addData(['myData', 'myDataValue']);

$body = new Body([$row2, $row3, $row4]);

$table = new Table();

$table->addCaption($caption);
$table->addHead($head);
$table->addBody($body);
$table->addFooter($footer);

$table->display();
