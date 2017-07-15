<?php

(new LetterGenerator())->generate('a', 'aab');

class LetterGenerator
{
    protected $list = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a'];

    public function generate($start, $stop)
    {
        $file = fopen("result.txt", "a") or die("Unable to open file!");

        $letters = $start;
        while ($letters != $stop) {
            fwrite($file, "$letters\n");
            echo "$letters\n";
            $letters = $this->nextLetters($letters);
        }
        fclose($file);
    }

    protected function nextLetters($letters)
    {
        $letters[-1] = $this->nextLetter($letters[-1]);
        return $this->checkPreLetter($letters);
    }

    protected function nextLetter($letter)
    {
        return $this->list[array_search($letter, $this->list) + 1];
    }

    protected function checkPreLetter($letters, $position = null)
    {
        $length = strlen($letters);
        if ($position === null) {
            $position = $length - 1;
        }

        if ($letters[$position] != 'a') {
            return $letters;
        }

        if ($position == 0) {
            return 'a' . $letters;
        }

        $letters[$position - 1] = $this->nextLetter($letters[$position - 1]);

        return $this->checkPreLetter($letters, $position - 1);
    }

}

