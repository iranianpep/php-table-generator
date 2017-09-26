<?php
    require '../vendor/autoload.php';

    use TableGenerator\Body;
    use TableGenerator\Cell;
    use TableGenerator\Head;
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

/**
 * first initialize the cells with content.
 */
$cell1 = new Cell('Cell 1 Content');
$cell2 = new Cell('Cell 2 Content');

/**
 * initialize a row with cells.
 *
 * you can also add cells later to the row using addCells()
 */
$row1 = new Row([$cell1, $cell2]);

/**
 * do the same thing to generate second row with cell3 and cell4.
 */
$cell3 = new Cell('Cell 3 Content');
$cell4 = new Cell('Cell 4 Content');

$row2 = new Row([$cell3, $cell4]);

/**
 * once more.
 */
$cell5 = new Cell('Cell 5 Content');
$cell6 = new Cell('Cell 6 Content');

$row3 = new Row([$cell5, $cell6]);

/**
 * initialize the head with row1.
 *
 * again row can be added later using addRow() method.
 * remember that head just accepts one row. So in this case there is no need to have an array
 */
$head = new Head($row1);

/**
 * initialize the body with row2 and row3 the same as head.
 *
 * again rows can be added later using addRow() or addRows()
 */
$body = new Body([$row2, $row3]);

/**
 * initialize the table object.
 */
$table = new Table();

/*
 * at the end add head and body to the table
 */
$table->addHead($head);
$table->addBody($body);

/*
 * print table. Don't forget this one!
 */
$table->display();
