<?php

namespace App\AppAdapter;

use App\CommonInterface\RequestInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Exception;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class AppRequest implements RequestInterface
{
    private Request $request;
    private static ?self $instance = null;

    private function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @required
     * @param Request $request
     * @return static
     */
    public static function getRequest(Request $request) : self
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($request);
        }

        return self::$instance;
    }

    private function __clone()
    {

    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->request->get($key, $default);
    }

    public function getSession() : SessionInterface
    {
        return $this->request->getSession();
    }

    public function __toString() : string
    {
        return $this->request->__toString();
    }

    public function setTrustedProxies(array $proxies, int $trustedHeaderSet)
    {
        $this->request::setTrustedProxies($proxies, $trustedHeaderSet);
    }

    public function getTrustedProxies() : array
    {
        return $this->request::getTrustedProxies();
    }

    public function getTrustedHeaderSet() : int
    {
        return $this->request::getTrustedHeaderSet();
    }

    public function setTrustedHosts(array $hostPatterns) : void
    {
        $this->request::setTrustedHosts($hostPatterns);
    }

    public function getTrustedHosts() : array
    {
        return $this->request::getTrustedHosts();
    }

    public function normalizeQueryString(?string $qs) : string
    {
        return $this->request::normalizeQueryString($qs);
    }

    public function enableHttpMethodParameterOverride()
    {
        $this->request::enableHttpMethodParameterOverride();
    }

    public function getHttpMethodParameterOverride() : bool
    {
        return $this->request::getHttpMethodParameterOverride();
    }

    public function hasPreviousSession() : bool
    {
        return $this->request->hasPreviousSession();
    }

    public function hasSession() : bool
    {
        return $this->request->hasSession();
    }

    public function setSession(SessionInterface $session)
    {
        $this->request->setSession($session);
    }

    public function setSessionFactory(callable $factory)
    {
        $this->request->setSessionFactory($factory);
    }

    public function getClientIps() : array
    {
        return $this->request->getClientIps();
    }

    public function getClientIp() : ?string
    {
        return $this->request->getClientIp();
    }

    public function getScriptName() : string
    {
        return $this->request->getScriptName();
    }

    public function getPathInfo() : string
    {
        return $this->request->getPathInfo();
    }

    public function getBasePath() : string
    {
        return $this->request->getBasePath();
    }

    public function getBaseUrl() : string
    {
       return $this->request->getBaseUrl();
    }

    public function getScheme() : string
    {
        return $this->request->getScheme();
    }

    public function getPort()
    {
        return $this->request->getPort();
    }

    public function getUser() : ?string
    {
        return $this->request->getUser();
    }

    public function getPassword() : ?string
    {
        return $this->request->getPassword();
    }

    public function getUserInfo() : ?string
    {
        return $this->request->getUserInfo();
    }

    public function getHttpHost() : string
    {
        return $this->request->getHttpHost();
    }

    public function getRequestUri() : string
    {
        return $this->request->getRequestUri();
    }

    public function getSchemeAndHttpHost() : string
    {
        return $this->request->getSchemeAndHttpHost();
    }

    public function getUri() : string
    {
        return $this->request->getUri();
    }

    public function getUriForPath(string $path) : string
    {
        return $this->request->getUriForPath($path);
    }

    public function getRelativeUriForPath(string $path) : string
    {
       return $this->request->getRelativeUriForPath($path);
    }

    public function getQueryString() : ?string
    {
        return $this->request->getQueryString();
    }

    public function isSecure() : bool
    {
        return $this->request->isSecure();
    }

    public function getHost() : string
    {
        return $this->request->getHost();
    }

    public function setMethod(string $method) : void
    {
        $this->request->setMethod($method);
    }

    public function getMethod() : string
    {
        return $this->request->getMethod();
    }

    public function getRealMethod() : string
    {
        return $this->request->getRealMethod();
    }

    public function getMimeType(string $format) : ?string
    {
        return $this->request->getMimeType($format);
    }

    public function getMimeTypes(string $format) : array
    {
        return $this->request::getMimeTypes($format);
    }

    public function getFormat(?string $mimeType) : ?string
    {
        return $this->request->getFormat($mimeType);
    }

    public function setFormat(?string $format, $mimeTypes)
    {
        $this->request->setFormat($format, $mimeTypes);
    }

    public function getRequestFormat(?string $default = 'html') : ?string
    {
        return $this->request->getRequestFormat($default);
    }

    public function setRequestFormat(?string $format) : void
    {
        $this->request->setRequestFormat($format);
    }

    public function getContentType() : ?string
    {
        return $this->request->getContentType();
    }

    public function setDefaultLocale(string $locale) : void
    {
        $this->request->setDefaultLocale($locale);
    }

    public function getDefaultLocale() : string
    {
        return $this->request->getDefaultLocale();
    }

    public function setLocale(string $locale) : void
    {
        $this->request->setLocale($locale);
    }

    public function getLocale() : string
    {
        return $this->request->getLocale();
    }

    public function isMethod(string $method) : bool
    {
        return $this->request->isMethod($method);
    }

    public function isMethodSafe() : bool
    {
        return $this->request->isMethodSafe();
    }

    public function isMethodIdempotent() : bool
    {
        return $this->request->isMethodIdempotent();
    }

    public function isMethodCacheable() : bool
    {
        return $this->request->isMethodCacheable();
    }

    public function getProtocolVersion() : ?string
    {
        return $this->request->getProtocolVersion();
    }

    public function getContent(bool $asResource = false)
    {
        return $this->request->getContent($asResource);
    }

    public function toArray() : array
    {
        return $this->request->toArray();
    }

    public function getETags() : array
    {
        return $this->request->getETags();
    }

    public function isNoCache() : bool
    {
        return $this->request->isNoCache();
    }

    public function getPreferredFormat(?string $default = 'html'): ?string
    {
        return $this->request->getPreferredFormat($default);
    }

    public function getPreferredLanguage(array $locales = null) : ?string
    {
        return $this->request->getPreferredLanguage($locales);
    }

    public function getLanguages() : array
    {
        return $this->request->getLanguages();
    }

    public function getCharsets() : array
    {
        return $this->request->getCharsets();
    }

    public function getEncodings() : array
    {
        return $this->request->getEncodings();
    }

    public function getAcceptableContentTypes() : array
    {
         return $this->request->getAcceptableContentTypes();
    }

    public function isXmlHttpRequest() : bool
    {
        return $this->request->isXmlHttpRequest();
    }

    public function preferSafeContent(): bool
    {
        return $this->request->preferSafeContent();
    }

    public function isFromTrustedProxy() : bool
    {
        return $this->request->isFromTrustedProxy();
    }

    public function getRequestAll() : array
    {
        return $this->request->request->all();
    }

    public function getQueryAll()
    {
        return $this->request->query->all();
    }

    public function getAttributeAll()
    {
        return $this->request->attributes->all();
    }

    public function getAllFile()
    {
        return $this->request->files->all();
    }
}
