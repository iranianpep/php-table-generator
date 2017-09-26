<?php
    require '../vendor/autoload.php';

    use TableGenerator\Body;
    use TableGenerator\Cell;
    use TableGenerator\Head;
    use TableGenerator\HeadCell;
    use TableGenerator\Row;
    use TableGenerator\Table;

    /**
 * it's not recommended to embed css. But for the sake of demo, it's fine.
 */
$css = <<<'EOF'
<style>
table, th, td {
    border: 1px solid black;
}
</style>
EOF;

echo $css;

$cell1 = new HeadCell('Head Cell 1 Content');
$cell1->setSortBy('first_head');
$cell1->setSortDir('acs');
$cell1->setSelectable(true);

$cell2 = new HeadCell('Head Cell 2 Content');
$cell2->setSortable(false);

$row1 = new Row([$cell1, $cell2]);

$cell3 = new Cell('Cell 3 Content');
$cell4 = new Cell('Cell 4 Content');

$row2 = new Row([$cell3, $cell4]);

$cell5 = new Cell('Cell 5 Content');
$cell6 = new Cell('Cell 6 Content');

$row3 = new Row([$cell5, $cell6]);

$head = new Head($row1);

$body = new Body([$row2, $row3]);

$table = new Table();

$table->addHead($head);
$table->addBody($body);

/*
 * print table. Don't forget this one!
 */
$table->display();
