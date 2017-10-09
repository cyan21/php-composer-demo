<?php 

use Ych\ArtifactoryInfo\ArtifactoryInfo;

 
class ArtifactoryInfoTest extends PHPUnit_Framework_TestCase {
 
  public function testArtifactory() {

    $ay = new ArtifactoryInfo;
    $this->assertTrue($ay->isOk());
  }

  public function testArtifactory2() {

    $ay = new ArtifactoryInfo;
    $this->assertRegExp('*hello*', $ay->hello());
  }

  public function testArtifactory3() {

    $ay = new ArtifactoryInfo;
    $this->assertRegExp('*Trial*', $ay->getLicense());
  }

}
