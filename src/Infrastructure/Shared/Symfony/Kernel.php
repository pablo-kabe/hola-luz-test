<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Symfony;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\Codec\OrderedTimeCodec;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function __construct(string $environment, bool $debug)
    {
        parent::__construct($environment, $debug);

        self::initUuidWithOrderedTimeCodec();
    }

    public static function initUuidWithOrderedTimeCodec(): void
    {
        $factory = new UuidFactory();
        $codec = new OrderedTimeCodec($factory->getUuidBuilder());
        $factory->setCodec($codec);
        Uuid::setFactory($factory);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import(sprintf('%s/config/{packages}/*.yaml', $this->getProjectDir()));
        $container->import(sprintf('%s/config/{packages}/%s/*.yaml', $this->getProjectDir(), $this->getEnvironment()));

        if (is_file(sprintf('%s/config/services.yaml', $this->getProjectDir()))) {
            $container->import(sprintf('%s/config/services.yaml', $this->getProjectDir()));
            $container->import(sprintf('%s/config/{services}_' . $this->environment . '.yaml', $this->getProjectDir(), $this->getEnvironment()));
        } elseif (is_file($path = sprintf('%s/config/services.php', $this->getProjectDir()))) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import(sprintf('%s/config/{routes}/%s/*.yaml', $this->getProjectDir(), $this->getEnvironment()));
        $routes->import(sprintf('%s/config/{routes}/*.yaml', $this->getProjectDir()));

        if (is_file(sprintf('%s/config/routes.yaml', $this->getProjectDir()))) {
            $routes->import(sprintf('%s/config/routes.yaml', $this->getProjectDir()));
        } elseif (is_file($path = sprintf('%s/config/routes.php', $this->getProjectDir()))) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
