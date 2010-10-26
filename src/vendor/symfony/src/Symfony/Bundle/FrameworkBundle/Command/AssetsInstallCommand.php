<?php

namespace Symfony\Bundle\FrameworkBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Bundle\FrameworkBundle\Util\Filesystem;

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * AssetsInstallCommand.
 *
 * @author Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class AssetsInstallCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setDefinition(array(
                new InputArgument('target', InputArgument::REQUIRED, 'The target directory'),
            ))
            ->addOption('symlink', null, InputOption::PARAMETER_NONE, 'Symlinks the assets instead of copying it')
            ->setName('assets:install')
        ;
    }

    /**
     * @see Command
     *
     * @throws \InvalidArgumentException When the target directory does not exist
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!is_dir($input->getArgument('target'))) {
            throw new \InvalidArgumentException(sprintf('The target directory "%s" does not exist.', $input->getArgument('target')));
        }

        $filesystem = new Filesystem();

        foreach ($this->container->getKernelService()->getBundles() as $bundle) {
            if (is_dir($originDir = $bundle->getPath().'/Resources/public')) {
                $output->writeln(sprintf('Installing assets for <comment>%s\\%s</comment>', $bundle->getNamespacePrefix(), $bundle->getName()));

                $targetDir = $input->getArgument('target').'/bundles/'.preg_replace('/bundle$/', '', strtolower($bundle->getName()));

                $filesystem->remove($targetDir);

                if ($input->getOption('symlink')) {
                    $filesystem->symlink($originDir, $targetDir);
                } else {
                    mkdir($targetDir, 0777, true);
                    $filesystem->mirror($originDir, $targetDir);
                }
            }
        }
    }
}
