<?php
namespace MapasCulturais\Traits;

trait ControllerChangeOwner{
    function POST_changeOwner(){
        $this->requireAuthentication();

        $app = \MapasCulturais\App::i();

        if(!key_exists('ownerId', $this->postData))
            $this->errorJson($app->txt('The ownerId is required.'));

        $owner = $app->repo('Agent')->find($this->postData['ownerId']);

        if(!$owner)
            $this->errorJson(sprintf ($app->txt('The agent with id %s not found.'), $this->postData['ownerId']));

        $entity = $this->requestedEntity;

        if(!$entity)
            $app->pass();

        $entity->owner = $owner;

        $this->_finishRequest($entity, true);
    }
}