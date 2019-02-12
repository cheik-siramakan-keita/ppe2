<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.authentication.listener.guard.main' shared service.

include_once $this->targetDirs[3].'\\vendor\\symfony\\security-http\\Firewall\\ListenerInterface.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\security-guard\\Firewall\\GuardAuthenticationListener.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\security-guard\\GuardAuthenticatorHandler.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\security-http\\Session\\SessionAuthenticationStrategyInterface.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\security-http\\Session\\SessionAuthenticationStrategy.php';

$a = new \Symfony\Component\Security\Guard\GuardAuthenticatorHandler(($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), ($this->services['event_dispatcher'] ?? $this->getEventDispatcherService()), array());
$a->setSessionAuthenticationStrategy(new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate'));

return $this->privates['security.authentication.listener.guard.main'] = new \Symfony\Component\Security\Guard\Firewall\GuardAuthenticationListener($a, ($this->privates['security.authentication.manager'] ?? $this->getSecurity_Authentication_ManagerService()), 'main', new RewindableGenerator(function () {
    yield 0 => ($this->privates['App\Security\LoginFormAuthenticator'] ?? $this->load('getLoginFormAuthenticatorService.php'));
}, 1), ($this->privates['monolog.logger.security'] ?? $this->load('getMonolog_Logger_SecurityService.php')));
