<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.09.14
 * Time: 22:08
 */

//define('ENVIRONMENT_PLATFORM', 'Development');

//define('ENVIRONMENT_PLATFORM', 'Testing');
//define('ENVIRONMENT_PLATFORM', 'Production');
define('ENVIRONMENT_PLATFORM', 'Development');
define('PATH_INDEX','');
define('DEFAULT_ENCODING', 'UTF-8');

define('PATH_META_BASE', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('PATH_PLATFORM_BASE', PATH_META_BASE.'..'.DIRECTORY_SEPARATOR);
define('PATH_PLATFORM_SRC', PATH_PLATFORM_BASE .'src' . DIRECTORY_SEPARATOR);
define('PATH_PLATFORM_CLASSES', PATH_PLATFORM_SRC . 'classes' . DIRECTORY_SEPARATOR);
define('PATH_CLASSES',PATH_PLATFORM_CLASSES);
define('PATH_META', PATH_PLATFORM_BASE . 'meta' . DIRECTORY_SEPARATOR);
define('PATH_PLATFORM_CONFIG', PATH_PLATFORM_BASE . 'config' . DIRECTORY_SEPARATOR);
define('PATH_PLATFORM_HELPERS', PATH_PLATFORM_CLASSES . 'Helpers' . DIRECTORY_SEPARATOR);
define('PATH_BIN', PATH_PLATFORM_BASE . 'bin' . DIRECTORY_SEPARATOR);

define('PATH_ONPHP_CORE', PATH_META_BASE.'..'.DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'onPHP' . DIRECTORY_SEPARATOR . 'onphp' . DIRECTORY_SEPARATOR);
define('PATH_ONPHP_UTILS', PATH_META_BASE.'..'.DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'onPHP' . DIRECTORY_SEPARATOR . 'onphputils' . DIRECTORY_SEPARATOR);

ini_set(
    'include_path', get_include_path() . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'DAOs' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Flow' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Business' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Proto' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Enumeration' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Base' . PATH_SEPARATOR
    . PATH_BIN . PATH_SEPARATOR
    . PATH_PLATFORM_HELPERS . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Auto' . DIRECTORY_SEPARATOR . 'Business' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Auto' . DIRECTORY_SEPARATOR . 'Proto' . PATH_SEPARATOR
    . PATH_PLATFORM_CLASSES . 'Auto' . DIRECTORY_SEPARATOR . 'DAOs' . PATH_SEPARATOR
    . PATH_PLATFORM_SRC . 'interfaces' . PATH_SEPARATOR
);

require_once(PATH_ONPHP_CORE . 'global.inc.php');
require_once(PATH_ONPHP_UTILS . 'src' . DIRECTORY_SEPARATOR . 'include.inc.php');

AutoloaderClassPathCache::create()
    ->setNamespaceResolver(NamespaceResolverOnPHP::create())
    ->addPath(PATH_PLATFORM_CLASSES . 'Base')
    ->register();

PlatformAutoloaderClassPathCache::create()
    ->setNamespaceResolver(NamespaceResolverOnPHP::create())
    ->addPaths(explode(PATH_SEPARATOR, get_include_path()))
    ->register();

Platform::create()->init();
