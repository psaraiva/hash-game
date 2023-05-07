<?php

namespace App\Command\Game;

use Minicli\Command\CommandController;

class MainController extends CommandController
{
    protected $erro = [];

    protected $tablePosition = ['A','B','C','D','E','F','G','H','I'];

    protected $tableValues = [];

    protected $player = ' ';

    protected $position = ' ';

    public function handle(): void
    {
        $this->tableValues = array_fill(0, 9, ' ');
        $this->getPrinter()->display($this->instructions());

        if (! $this->isValidParans()) {
             $this->getPrinter()->display($this->getErroMessages());
             return;
         }

         $this->getPrinter()->display($this->renderTableUpdated());
    }

    protected function instructions(): string
    {
        $table  = '+-----------------------------+'.PHP_EOL;
        $table .= '|Instructions:                |'.PHP_EOL;
        $table .= '|Use X or O to value of player|'.PHP_EOL;
        $table .= '+-----------------------------+'.PHP_EOL;
        $table .= '|          Positions          |'.PHP_EOL;
        $table .= '|            A|B|C            |'.PHP_EOL;
        $table .= '|            -+-+-            |'.PHP_EOL;
        $table .= '|            D|E|F            |'.PHP_EOL;
        $table .= '|            -+-+-            |'.PHP_EOL;
        $table .= '|            G|H|I            |'.PHP_EOL;
        $table .= '+-----------------------------+'.PHP_EOL;
        return $table;
    }

    protected function isValidParans(): bool
    {
        $success = $this->isValidPosition();
        $success = $success && $this->isValidPlayer();
        return $success;
    }

    protected function isValidPosition(): bool
    {
        if (! $this->hasParam('position')) {
            return true;
        }

        $this->position = $this->hasParam('position') ? strtoupper($this->getParam('position')) : '';
        $success = array_key_exists($this->position, array_flip($this->tablePosition));
        if (! $success) {
            $this->erro[] = sprintf('Invalid value to position: \'%s\'', $this->position);
        }

        return $success;
    }

    protected function isValidPlayer(): bool
    {
        if (! $this->hasParam('player')) {
            return true;
        }

        $this->player = $this->hasParam('player') ? strtoupper($this->getParam('player')) : '';
        $success = $this->player == 'X' || $this->player == 'O';
        if (! $success) {
            $this->erro[] = sprintf('Invalid value to player: \'%s\'', $this->player);
        }

        return $success;
    }

    protected function getErroMessages(): string
    {
        return implode(PHP_EOL, $this->erro);
    }

    protected function renderTableUpdated(): string
    {
        $this->replacePositionPlayer($this->position, $this->player);
        return $this->parseTableValueToString();
    }

    protected function replacePositionPlayer($position, $player): void
    {
        $key = array_search($position, $this->tablePosition);
        if ($key !== false) {
            $this->tableValues[$key] = $player;
        }
    }

    protected function parseTableValueToString(): string
    {
        $line  = '+---------+'.PHP_EOL;
        $line .= '|.:GAME!:.|'.PHP_EOL;
        $line .= '+---------+'.PHP_EOL;

        $pad = '   ';
        for ($i=0; $i<=2; $i++) {
            $line .= $pad . implode('|', array_slice($this->tableValues, $i*3, 3)) . PHP_EOL;
            if ($i < 2) {
                $line .= $pad . '-+-+-'.PHP_EOL;
            }
        }

        $line .= '+---------+'.PHP_EOL;
        return $line;
    }
}
