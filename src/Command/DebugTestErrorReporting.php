<?php

declare(strict_types=1);

namespace AdgoalCommon\ErrorReportingBundle\Command;

use AdgoalCommon\CommandBus\Event\CommandFailed;
use AdgoalCommon\ErrorReporting\Infrastructure\Event\Publisher\CommandErrorPublisher;
use ErrorException;
use Exception;
use stdClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProgramRunCommand.
 */
class DebugTestErrorReporting extends Command
{
    private $commandErrorPublisher;


    /**
     * AfmCommand constructor.
     */
    public function __construct(
        CommandErrorPublisher $commandErrorPublisher
    ){
        parent::__construct('debug:test-error-reporting');
        $this->commandErrorPublisher = $commandErrorPublisher;
    }

    protected function configure(): void
    {
        $this->setName('debug:test-error-reporting');
    }

    /**
     * @throws Exception
     *
     * @phan-suppress PhanUnusedProtectedMethodParameter
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            throw new ErrorException('Test Exception');
        } catch (ErrorException $exception) {
            $this->commandErrorPublisher->handle(new CommandFailed(new stdClass(), $exception));
        }

        return 0;
    }
}
