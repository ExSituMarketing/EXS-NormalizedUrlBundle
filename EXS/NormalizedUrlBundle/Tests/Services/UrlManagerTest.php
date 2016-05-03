<?php

namespace AppBundle\Tests\Services;

use AppBundle\Services\Url\UrlManager;
use AppBundle\Entity\Host;
use AppBundle\Entity\Path;
use AppBundle\Entity\Querystring;
use AppBundle\Entity\Url;

/**
 * Description of UrlManagerTest
 *
 * @author lee
 */
class UrlManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExidManager
     */
    private $service;

    public function setUp()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('persist', 'flush'))->getMock();
        $em->expects($this->any())->method('persist')->will($this->returnValue(true));      
        $em->expects($this->any())->method('flush')->will($this->returnValue(true)); 
        $this->service = new UrlManager($em); 
    }
    
    public function testSetEntity()
    {
        $entity = new \stdClass();
        $entity->id = 1;
        $res = $this->service->SetEntity($entity);
        $this->assertEquals($res, $entity);
    }
    
    public function testCreateUrl()
    {        
        $res = $this->service->createUrl('testhash', new Host(), new Path(), new Querystring());
        $this->assertInstanceOf('AppBundle\Entity\Url', $res);
        $this->assertEquals('testhash', $res->getHashkey());
        $this->assertInstanceOf('AppBundle\Entity\Host', $res->getHost());
        $this->assertInstanceOf('AppBundle\Entity\Path', $res->getPath());
        $this->assertInstanceOf('AppBundle\Entity\Querystring', $res->getQuerystring());
    }
    
    public function testGenerateUrlHash()
    {        
        $random = '';
        for ($i = 0; $i < 260; $i++) {
          $random .= chr(mt_rand(33, 126));
        }
        $url = "http://www.test.local/".$random;
        $res = $this->service->generateUrlHash($url);
        $this->assertEquals(md5(substr($url, 0, 255)), $res);
    }
    
    public function testGetUrlByHash()
    {
        $url = array(0 => new Url());
        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue($url));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getUrlByHash'))->getMock();
        $qry->expects($this->any())->method('getUrlByHash')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('getRepository'))->getMock();
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);     
        
        $res = $service->getUrlByHash('testhash');
        $this->assertInstanceOf('AppBundle\Entity\Url', $res);
        
        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue(false));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getUrlByHash'))->getMock();
        $qry->expects($this->any())->method('getUrlByHash')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('getRepository'))->getMock();
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);     
        
        $res = $service->getUrlByHash('testhash');
        $this->assertFalse($res);        
    }
    
    
    public function testProcessHost()
    {
        $host = array(0 => new Host());
        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue($host));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getHostByName'))->getMock();
        $qry->expects($this->any())->method('getHostByName')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('getRepository'))->getMock();
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);        
        
        $hostName = 'www.test.local';
        $res = $service->processHost($hostName);
        $this->assertInstanceOf('AppBundle\Entity\Host', $res); 
        

        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue(false));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getHostByName'))->getMock();
        $qry->expects($this->any())->method('getHostByName')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('persist', 'flush', 'getRepository'))->getMock();
        $em->expects($this->any())->method('persist')->will($this->returnValue(true));      
        $em->expects($this->any())->method('flush')->will($this->returnValue(true)); 
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);        
        
        $hostName = 'www.test.local';
        $res = $service->processHost($hostName);
        $this->assertInstanceOf('AppBundle\Entity\Host', $res);     
        
        $res = $service->processHost('');
        $this->assertEquals(null, $res);         
    }
    
    public function testProcessPath()
    {
        $path = array(0 => new Path());
        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue($path));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getPathByName'))->getMock();
        $qry->expects($this->any())->method('getPathByName')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('getRepository'))->getMock();
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);        
        
        $pathName = '/test/test.html';
        $res = $service->processPath($pathName);
        $this->assertInstanceOf('AppBundle\Entity\Path', $res); 
        

        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue(false));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getPathByName'))->getMock();
        $qry->expects($this->any())->method('getPathByName')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('persist', 'flush', 'getRepository'))->getMock();
        $em->expects($this->any())->method('persist')->will($this->returnValue(true));      
        $em->expects($this->any())->method('flush')->will($this->returnValue(true)); 
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);        
        
        $pathName = '/test/test.html';
        $res = $service->processPath($pathName);
        $this->assertInstanceOf('AppBundle\Entity\Path', $res);     
        
        $res = $service->processPath('');
        $this->assertEquals(null, $res);         
    }    
    
    public function testProcessQuerystring()
    {
        $querystring = array(0 => new Querystring());
        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue($querystring));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getQuerystringByName'))->getMock();
        $qry->expects($this->any())->method('getQuerystringByName')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('getRepository'))->getMock();
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);        
        
        $querystringName = 'test=lala';
        $res = $service->processQuerystring($querystringName);
        $this->assertInstanceOf('AppBundle\Entity\Querystring', $res); 
        

        $repo = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repo->expects($this->any())->method('getResult')->will($this->returnValue(false));   
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getQuerystringByName'))->getMock();
        $qry->expects($this->any())->method('getQuerystringByName')->will($this->returnValue($repo));       
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('persist', 'flush', 'getRepository'))->getMock();
        $em->expects($this->any())->method('persist')->will($this->returnValue(true));      
        $em->expects($this->any())->method('flush')->will($this->returnValue(true)); 
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        $service = new UrlManager($em);        
        
        $querystringName = 'test=lala';
        $res = $service->processQuerystring($querystringName);
        $this->assertInstanceOf('AppBundle\Entity\Querystring', $res);     
        
        $res = $service->processQuerystring('');
        $this->assertEquals(null, $res);         
    }    
    
    public function testProcessUrl()
    {
        $urlHash = 'testhash';
        $refData = new \stdClass();
        $refData->host = '';
        $refData->path =  '';
        $refData->qs = '';
        
        $url = $this->getMockBuilder('AppBundle\Entity\Url')->disableOriginalConstructor()->setMethods(array('getId'))->getMock();
        $url->expects($this->any())->method('getId')->will($this->returnValue(10));  
        
        $res = $this->service->processUrl($url, $urlHash, $refData);
        $this->assertEquals(10, $res);    
             
        $repoHost = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoHost->expects($this->any())->method('getResult')->will($this->returnValue(false));   
        $repoPath = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoPath->expects($this->any())->method('getResult')->will($this->returnValue(false)); 
        $repoQs = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoQs->expects($this->any())->method('getResult')->will($this->returnValue(false));   
        
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getPathByName', 'getHostByName', 'getQuerystringByName'))->getMock();
        $qry->expects($this->any())->method('getPathByName')->will($this->returnValue($repoPath));       
        $qry->expects($this->any())->method('getHostByName')->will($this->returnValue($repoHost)); 
        $qry->expects($this->any())->method('getQuerystringByName')->will($this->returnValue($repoQs)); 
        
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('persist', 'flush', 'getRepository'))->getMock();
        $em->expects($this->any())->method('persist')->will($this->returnValue(true));      
        $em->expects($this->any())->method('flush')->will($this->returnValue(true)); 
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        
        $service = new UrlManager($em); 
        
        $res = $service->processUrl(false, $urlHash, $refData);
        $this->assertEquals(null, $res);
    }
    
    public function testGetUrl()
    {        
        $refData = new \stdClass();
        $refData->url = 'http://test.com/test?test=lala';
        $refData->host = 'test.com';
        $refData->path =  '/test';
        $refData->qs = 'test=lala';
        
        $res = $this->service->getUrl(null);
        $this->assertEquals(null, $res);      
        
        $urlMock = $this->getMockBuilder('AppBundle\Entity\Url')->disableOriginalConstructor()->setMethods(array('getId'))->getMock();
        $urlMock->expects($this->any())->method('getId')->will($this->returnValue(10)); 
        
        $path = array(0 => new Path());
        $host = array(0 => new Host());
        $querystring = array(0 => new Querystring());
        $url = array(0 => $urlMock);
        
        $repoHost = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoHost->expects($this->any())->method('getResult')->will($this->returnValue($host));   
        $repoPath = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoPath->expects($this->any())->method('getResult')->will($this->returnValue($path)); 
        $repoQs = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoQs->expects($this->any())->method('getResult')->will($this->returnValue($querystring));   
        $repoUrl = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getResult'))->getMock();
        $repoUrl->expects($this->any())->method('getResult')->will($this->returnValue($url));         
        
        $qry = $this->getMockBuilder('Repository')->disableOriginalConstructor()->setMethods(array('getUrlByHash', 'getPathByName', 'getHostByName', 'getQuerystringByName'))->getMock();
        $qry->expects($this->any())->method('getPathByName')->will($this->returnValue($repoPath));       
        $qry->expects($this->any())->method('getHostByName')->will($this->returnValue($repoHost)); 
        $qry->expects($this->any())->method('getQuerystringByName')->will($this->returnValue($repoQs)); 
        $qry->expects($this->any())->method('getUrlByHash')->will($this->returnValue($repoUrl));
        
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->setMethods(array('persist', 'flush', 'getRepository'))->getMock();
        $em->expects($this->any())->method('persist')->will($this->returnValue(true));      
        $em->expects($this->any())->method('flush')->will($this->returnValue(true)); 
        $em->expects($this->any())->method('getRepository')->will($this->returnValue($qry));
        
        $service = new UrlManager($em);           
        
        $res = $service->getUrl($refData);
        $this->assertEquals(10, $res);                   
    }    
}
