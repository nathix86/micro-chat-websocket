<?php

namespace AppBundle\Topics;

use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;

class MessagesTopic implements TopicInterface
{
    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        $broadcast = array(
            'msg' => $connection->resourceId . " has joined " . $topic->getId()
        );

        $topic->broadcast($broadcast);
    }

    /**
     * This will receive any UnSubscription requests for this topic.
     *
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        $broadcast = array(
            'msg' => $connection->resourceId . " has left " . $topic->getId()
        );

        $topic->broadcast($broadcast);
    }

    /**
     * This will receive any Publish requests for this topic.
     *
     * @param  ConnectionInterface $connection
     * @param  Topic $topic
     * @param WampRequest $request
     * @param $event
     * @param  array $exclude
     * @param  array $eligible
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
    {
        $broadcast = array(
            'msg' => $event
        );

        $topic->broadcast($broadcast);
    }

    /**
     * Like RPC is will use to prefix the channel
     *
     * @return string
     */
    public function getName()
    {
        return 'messages.topic';
    }
}