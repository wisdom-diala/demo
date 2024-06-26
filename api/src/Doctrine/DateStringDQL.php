<?php
declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\TokenType;

class DateStringDQL extends FunctionNode
{
    public $date;
    // public $format;

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'TO_CHAR(' . $this->date->dispatch($sqlWalker) . ", 'YYYY-MM-DD')";
    }

    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);
        $this->date = $parser->ArithmeticPrimary();
        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }
}
