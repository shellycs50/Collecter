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
        $testObjs[] = $testType;
        $result = BodytypeViewHelper::optionList($testObjs);
        
        $this->assertEquals("<option value='1000'>Imaginery Car Brand</option>", $result);
    }

    public function test_optionList_failure(): void 
    {
        $testObjs = [];
        $result = BodytypeViewHelper::optionList($testObjs);
        
        $this->assertEquals("", $result);
    }
}