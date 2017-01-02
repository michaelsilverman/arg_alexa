<?php

/**
 * Created by PhpStorm.
 * User: michaelsilverman
 * Date: 12/22/16
 * Time: 11:56 AM
 */

namespace Drupal\srg_alexa\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
//use Drupal\dino_roar\Jurassic\RoarGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class AlexaController extends ControllerBase
{

    public function __construct(LoggerChannelFactoryInterface $loggerFactory)
    {
    //    $this->roarGenerator = $alexaGenerator;
        $this->loggerFactory = $loggerFactory;
    }

    public function loginfo()
    {
     //   $roar = $this->roarGenerator->getRoar();
        $this->loggerFactory->get('default')
            ->debug('this WORKED!');
    //    $json = '{"new":false,"sessionId":"SessionId.89b23018-0add-43b6-8317-80f89237059b","application":{"applicationId":"amzn1.ask.skill.3d0f198d-bf97-4f1c-9f73-cb35ad9766e0","attributes":@,"user":@"userId":"amzn1.ask.account.AHMNKQB557I522GRILRO4JXZSF3FYTMLO37Q5HIVDYGIOVACKURLJU65A3NN3Y3JDUJNVBHMPGMIL4EJW4MOIOQE7VAC3KCTVDKPB4QCKMANNT77JLAFK5UZPXM3YFTNUBYLE6CQANWD5ZGNS2JR4SKKZNMZLI235BH43YNOHGDY5TJZINFIYNKJ6ZXWYOGXWDB6PJ4OH45CQ4I"},"request":@"type":"IntentRequest","requestId":"EdwRequestId.a4498593-b812-4322-b8ad-a7527e2c6682","timestamp":"2017-01-01T22:31:25Z","locale":"en-US","intent":{"name":"HelloDrupal","slots":{"City":{"name":"City","value":"Boston"}}}}';
        $json = '{
  "session": {
    "sessionId": "SessionId.89b23018-0add-43b6-8317-80f89237059b",
    "application": {
      "applicationId": "amzn1.ask.skill.3d0f198d-bf97-4f1c-9f73-cb35ad9766e0"
    },
    "attributes": {},
    "user": {
      "userId": "amzn1.ask.account.AHMNKQB557I522GRILRO4JXZSF3FYTMLO37Q5HIVDYGIOVACKURLJU65A3NN3Y3JDUJNVBHMPGMIL4EJW4MOIOQE7VAC3KCTVDKPB4QCKMANNT77JLAFK5UZPXM3YFTNUBYLE6CQANWD5ZGNS2JR4SKKZNMZLI235BH43YNOHGDY5TJZINFIYNKJ6ZXWYOGXWDB6PJ4OH45CQ4I"
    },
    "new": false
  },
  "request": {
    "type": "IntentRequest",
    "requestId": "EdwRequestId.a4498593-b812-4322-b8ad-a7527e2c6682",
    "locale": "en-US",
    "timestamp": "2017-01-01T22:31:25Z",
    "intent": {
      "name": "HelloDrupal",
      "slots": {
        "City": {
          "name": "City",
          "value": "Boston"
        }
      }
    }
  },
  "version": "1.0"
}';
        $arr = json_decode($json, TRUE);
  //      var_dump($arr);
        dpm($arr, 'array');
        $fred = $arr['request']['intent']['slots']['City']['value'];
        dpm($fred, 'fred');
     //   return new Response('11'.$roar); // return unthemed page
        return [
          '#title' => 'This is the TEST title',
        ];
    }

    public static function create(ContainerInterface $container)
    {
    //    $roarGenerator = $container->get('dino_roar.roar_generator');
        $loggerFactory = $container->get('logger.factory');
        return new static($loggerFactory);
    }
}