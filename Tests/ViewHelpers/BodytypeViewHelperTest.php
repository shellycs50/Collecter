<?php
require_once 'src/ViewHelpers/BodytypeViewHelper.php';
require_once 'src/Entities/Bodytype.php';
use PHPUnit\Framework\TestCase;

class BodytypeViewHelperTest extends TestCase
{
    public function test_optionList_success(): void
    {
        $testObjs = [];
        $testType = new Bodytype(1000, 'Imaginery Car Brand');
        $result = BodytypeViewHelper::optionList([$testType]);
        
        $this->assertEquals("<option value='1000'>Imaginery Car Brand</option>", $result);
    }

    public function test_optionList_failure(): void 
    {
        $result = BodytypeViewHelper::optionList([]);
        
        $this->assertEquals("", $result);
    }
}