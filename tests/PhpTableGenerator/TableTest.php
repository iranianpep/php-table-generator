<?php

namespace TableGenerator;

use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
    /**
     * Test getHtml.
     */
    public function testSimpleTable()
    {
        $cell1 = new Cell('Cell 1 Content');
        $cell2 = new Cell('Cell 2 Content');
        $cell3 = new Cell('Cell 3 Content');
        $cell4 = new Cell('Cell 4 Content');
        $cell5 = new Cell('Cell 5 Content');
        $cell6 = new Cell('Cell 6 Content');

        $row1 = new Row([$cell1, $cell2]);
        $row2 = new Row([$cell3, $cell4]);
        $row3 = new Row([$cell5, $cell6]);

        $head = new Head($row1);
        $body = new Body([$row2, $row3]);

        $table = new Table();
        $table->addHead($head);
        $table->addBody($body);

        // print table. Don't forget this one!
        $html = $table->getHtml();

        $expectedHtml = '<table>';
        $expectedHtml .= '<thead><tr><td>Cell 1 Content</td><td>Cell 2 Content</td></tr></thead>';
        $expectedHtml .= '<tbody><tr><td>Cell 3 Content</td><td>Cell 4 Content</td></tr>';
        $expectedHtml .= '<tr><td>Cell 5 Content</td><td>Cell 6 Content</td></tr></tbody>';
        $expectedHtml .= '</table>';

        $this->assertEquals($expectedHtml, $html);
    }

    /**
     * Test getHtml.
     */
    public function testSimpleTableAddCell()
    {
        $cell1 = new Cell('Cell 1 Content');
        $cell1->addScope('col');

        $cell2 = new Cell('Cell 2 Content');
        $cell2->addScope('col');

        $row1 = new Row([$cell1, $cell2]);
        $row1->class = 'firstRow';

        $cell3 = new Cell('Cell 3 Content');
        $cell4 = new Cell('Cell 4 Content');
        $cell4->style = 'background-color: lightblue;';

        $row2 = new Row([$cell3]);
        $row2->addCell($cell2, 0);

        $cell5 = new Cell('Cell 5 Content');
        $cell5->id = 'fifthCell';

        $cell6 = new Cell('Cell 6 Content');

        $row3 = new Row([$cell5, $cell6]);

        $head = new Head($row1);
        $head->addData('myData', 'myDataValue');

        $body = new Body([$row2, $row3]);

        $table = new Table();

        $table->addHead($head);
        $table->addBody($body);

        $html = $table->getHtml();

        $expectedHtml = "<table><thead data-myData=myDataValue><tr class='firstRow'><td scope = \"col\">Cell 1 Content</td><td scope = \"col\">Cell 2 Content</td></tr></thead><tbody><tr><td scope = \"col\">Cell 2 Content</td><td>Cell 3 Content</td></tr><tr><td id='fifthCell'>Cell 5 Content</td><td>Cell 6 Content</td></tr></tbody></table>";

        $this->assertEquals($expectedHtml, $html);
    }

    /**
     * Test getHtml.
     */
    public function testSimpleTableAddRow()
    {
        $cell1 = new Cell('Cell 1 Content');
        $cell1->addScope('col');

        $cell2 = new Cell('Cell 2 Content');
        $cell2->addScope('col');

        $row1 = new Row([$cell1, $cell2]);
        $row1->class = 'firstRow';

        $cell5 = new Cell('Cell 5 Content');
        $cell5->id = 'fifthCell';

        $cell6 = new Cell('Cell 6 Content');

        $row3 = new Row([$cell5, $cell6]);

        $head = new Head($row1);
        $head->addData('myData', 'myDataValue');

        $body = new Body([$row3]);

        $cell3 = new Cell('Cell 3 Content');
        $cell4 = new Cell('Cell 4 Content');
        $cell4->style = 'background-color: lightblue;';

        $row2 = new Row([$cell3, $cell4]);

        $body->addRow($row2, 0);

        $table = new Table();

        $table->addHead($head);
        $table->addBody($body);

        $html = $table->getHtml();
        $this->assertEquals("<table><thead data-myData=myDataValue><tr class='firstRow'><td scope = \"col\">Cell 1 Content</td><td scope = \"col\">Cell 2 Content</td></tr></thead><tbody><tr><td>Cell 3 Content</td><td style='background-color: lightblue;'>Cell 4 Content</td></tr><tr><td id='fifthCell'>Cell 5 Content</td><td>Cell 6 Content</td></tr></tbody></table>", $html);
    }

    /**
     * Test getHtml.
     */
    public function testSimpleTableAttributes()
    {
        $cell1 = new Cell('Cell 1 Content');
        $cell1->addScope('col');

        $cell2 = new Cell('Cell 2 Content');
        $cell2->addScope('col');

        $row1 = new Row([$cell1, $cell2]);
        $row1->class = 'firstRow';

        $cell3 = new Cell('Cell 3 Content');
        $cell4 = new Cell('Cell 4 Content');
        $cell4->style = 'background-color: lightblue;';

        $row2 = new Row([$cell3, $cell4]);

        $cell5 = new Cell('Cell 5 Content');
        $cell5->id = 'fifthCell';

        $cell6 = new Cell('Cell 6 Content');

        $row3 = new Row([$cell5, $cell6]);

        $head = new Head($row1);
        $head->addData('myData', 'myDataValue');

        $body = new Body([$row2, $row3]);

        $table = new Table();

        $table->addHead($head);
        $table->addBody($body);

        $html = $table->getHtml();
        $this->assertEquals("<table><thead data-myData=myDataValue><tr class='firstRow'><td scope = \"col\">Cell 1 Content</td><td scope = \"col\">Cell 2 Content</td></tr></thead><tbody><tr><td>Cell 3 Content</td><td style='background-color: lightblue;'>Cell 4 Content</td></tr><tr><td id='fifthCell'>Cell 5 Content</td><td>Cell 6 Content</td></tr></tbody></table>", $html);
    }

    /**
     * Test getHtml.
     */
    public function testSimpleTableRowspanColspan()
    {
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

        $head = new Head($row1);
        $head->addData('myData', 'myDataValue');

        $body = new Body([$row2, $row3, $row4]);

        $table = new Table();

        $table->addHead($head);
        $table->addBody($body);

        $html = $table->getHtml();
        $this->assertEquals("<table><thead data-myData=myDataValue><tr class='firstRow'><td scope = \"col\">Cell 1 Content</td><td scope = \"col\">Cell 2 Content</td></tr></thead><tbody><tr><td rowspan = \"2\">Cell 3 Content</td><td style='background-color: lightblue;'>Cell 4 Content</td></tr><tr><td id='fifthCell'>Cell 5 Content</td></tr><tr><td colspan = \"2\">Cell 6 Content</td></tr></tbody></table>", $html);
    }

    /**
     * Test getHtml.
     */
    public function testTableComplete()
    {
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
        $caption->addData('captionData', 'captionDataValue');

        $head = new Head($row1);
        $head->addData('myData', 'myDataValue');

        $body = new Body([$row2, $row3, $row4]);

        $table = new Table();

        $table->addCaption($caption);
        $table->addHead($head);
        $table->addBody($body);
        $table->addFooter($footer);

        $html = $table->getHtml();
        $this->assertEquals("<table><caption class='captionClass' data-captionData=captionDataValue>This is caption content</caption><thead data-myData=myDataValue><tr class='firstRow'><td scope = \"col\">Cell 1 Content</td><td scope = \"col\">Cell 2 Content</td></tr></thead><tfoot><tr><td>Cell 7 Content</td><td>Cell 8 Content</td></tr></tfoot><tbody><tr><td rowspan = \"2\">Cell 3 Content</td><td style='background-color: lightblue;'>Cell 4 Content</td></tr><tr><td id='fifthCell'>Cell 5 Content</td></tr><tr><td colspan = \"2\">Cell 6 Content</td></tr></tbody></table>", $html);
    }
}
