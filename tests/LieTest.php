<?php 

class LieTest extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        /**
         * create data source
         * create contents of a LieTestcreate lie object
         * pass contents into the add method
         * assert that it added things
         */
        $statement = $this->getMockBuilder('StdClass')
            ->setMethods(['execute', 'rowCount'])
            ->getMock();
        $statement->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));
        $statement->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));

        // create our mock db conncetion
        $db = $this->getMockBuilder('FakePDO')
            ->setMethods(['prepare'])
            ->getMock();

        $db->expects($this->once())
            ->method('prepare')
            ->will($this->returnValue($statement));

        $lie = new LieModel();
        $lie->setDb($db);

        // doesn't like to use autoincrements... uses UUIDs or a uniqid
        $data = [
            'id' => uniqid(),
                'contents' => 'This is not a spammy comment',
                'entry_date' => time(),
                ];

        $response = $lie->add($data);

        $this->assertTrue(
            $response,
            'Did not add lie to system as expected'
        );
    }
}

class FakePDO extends PDO
{
    public function __construct()
    {
        // DO NOTHING
    }

    public function setMethods(array $methods = array())
    {
        
    }


}

