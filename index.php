<?php

const ROOT = __DIR__;

require ROOT . "/functions/require.php";

logs();



$leadsArr = null;
$responseUser = null;

if(!empty($_REQUEST["LeadId"])) {

    $leadsArr = [$_REQUEST["LeadId"]];

    $responseUser = $_REQUEST["RespUserId"];

} else if(!empty($_REQUEST["data"]["leadsId"])) {

    $leadsArr = $_REQUEST["data"]["leadsId"];

    $responseUser = $_REQUEST["data"]["responseUser"];
}


if(isset($leadsArr) && isset($responseUser)) {

    foreach ($leadsArr as $value) {

        $getLeadRelation = entityRelation(CRM_ENTITY_LEAD, $value);


        if(!empty($getLeadRelation["_embedded"]["links"])) {

            $attachedEntities = $getLeadRelation["_embedded"]["links"];

            foreach ($attachedEntities as $entity) {

                if($entity["to_entity_type"] == "contacts") {

                    editEntity(CRM_ENTITY_CONTACT, $entity["to_entity_id"], $responseUser);


                } else if($entity["to_entity_type"] == "companies") {

                    editEntity(CRM_ENTITY_COMPANY, $entity["to_entity_id"], $responseUser);

                }

            }
        }





    }


}







































