<?php

namespace Kusabi\Router\Routes;

use Kusabi\Router\ActionInterface;
use Kusabi\Router\Actions\NullAction;
use Kusabi\Router\Exceptions\InvalidVerbException;
use Kusabi\Router\RouteInterface;

/**
 * The standard route class defined by this library
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class Route implements RouteInterface
{
    /**
     * ANY verb string
     *
     * @var string
     */
    const ANY = 'any';

    /**
     * GET verb string
     *
     * @var string
     */
    const GET = 'get';

    /**
     * POST verb string
     *
     * @var string
     */
    const POST = 'post';

    /**
     * PUT verb string
     *
     * @var string
     */
    const PUT = 'put';

    /**
     * PATCH verb string
     *
     * @var string
     */
    const PATCH = 'patch';

    /**
     * DELETE verb string
     *
     * @var string
     */
    const DELETE = 'delete';

    /**
     * An array of all verbs
     *
     * @var array
     */
    const VERBS = [
        self::GET,
        self::POST,
        self::PUT,
        self::PATCH,
        self::DELETE,
        self::ANY,
    ];

    /**
     * The HTTP verb for this route
     *
     * @var string
     */
    protected $verb;

    /**
     * The uri pattern
     *
     * @var string
     */
    protected $pattern;

    /**
     * The action to use if this route matches
     *
     * @var ActionInterface
     */
    protected $action;

    /**
     * Route constructor.
     *
     * @param string $verb Default value is 'GET'
     * @param string $pattern Default value is ''
     * @param ActionInterface|null $action Default action is `new NullAction()`
     *
     * @throws InvalidVerbException when verb is not supported
     *
     */
    public function __construct(string $verb = self::GET, string $pattern = '', ActionInterface $action = null)
    {
        $this->setVerb($verb);
        $this->setPattern($pattern);
        $this->setAction($action ?? new NullAction());
    }

    /**
     * {@inheritdoc}
     */
    public function getVerb(): string
    {
        return $this->verb;
    }

    /**
     * Set the HTTP verb
     *
     * @param string $verb
     *
     * @throws InvalidVerbException when verb is not supported
     *
     * @return self
     */
    public function setVerb(string $verb): self
    {
        // Make lower case
        $lower = strtolower($verb);

        // Is verb supported?
        if (!in_array($lower, self::VERBS)) {
            throw new InvalidVerbException($verb);
        }

        // Set the verb
        $this->verb = $lower;

        // Return fluid
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * Set the route pattern
     *
     * @param string $pattern
     *
     * @return self
     */
    public function setPattern(string $pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAction(): ActionInterface
    {
        return $this->action;
    }

    /**
     * Set the action
     *
     * @param ActionInterface $action
     *
     * @return self
     */
    public function setAction(ActionInterface $action): self
    {
        $this->action = $action;
        return $this;
    }
}
