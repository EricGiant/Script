class BoardGame
{
    const char BLACK = 'B', WHITE = 'W', NOTHING = 'N';
    const string WON = "WON";

    readonly char[] PossiblePegColors = { 'B', 'G', 'R', 'M', 'Y', 'P' };
    int CodeSize { get; set; }
    int Chances { get; set; }
    string Code { get; set; } = "";
    readonly Random Random = new();

    public BoardGame(bool isHuman = false, int codeSize = 4, int chances = 12)
    {
        CodeSize = codeSize;
        Chances = chances;

        CreateCode();

        Console.WriteLine("Press any key to start the game");
        Console.ReadKey();
        Console.Clear();

        if (isHuman)
        {
            HumanGameLoop();
        }
        else
        {
            AIGameLoop("");
        }
    }

    void CreateCode()
    {
        Console.WriteLine("Choice " + CodeSize + " pegs to be your code\nPossible pegs: " + string.Join("/", PossiblePegColors));

        Code = ReadPegs();

        Console.WriteLine("Your code is: " + Code);
    }

    bool HumanGameLoop()
    {
        Console.WriteLine("Chances left " + Chances);
        if (Chances == 0)
        {
            Console.WriteLine("You Lost");
            return false;
        }
        else
        {
            Chances--;
        }

        Console.WriteLine("Guess the code");

        string input = ReadPegs();

        string pegs = CalculatePegs(input);

        if (pegs == WON)
        {
            Console.WriteLine("You guessed the code");
            return true;
        }

        Console.WriteLine("Your filled in code with pegs\n" + input);
        Console.WriteLine(pegs);

        return HumanGameLoop();
    }

    //AI does not look for white pegs due to how complicated it would be to implomented, white pegs rn aren't implomented very well
    //so making an AI based on it would be insanely complex, white pegs just don't provide enough context and info in the current state
    //even for the human player they have a few weird interactions but due to the nature of a normal player this won't be a problem
    //but for AI it compleetly bricks the AI very quickly
    bool AIGameLoop(string nextMove)
    {
        Console.WriteLine("Chances left " + Chances);
        if (Chances == 0)
        {
            Console.WriteLine("AI Lost");
            return false;
        }
        else
        {
            Chances--;
        }

        if (nextMove == "")
        {
            for (int i = 0; i < CodeSize; i++)
            {
                int randomValue = Random.Next(0, PossiblePegColors.Length - 1);
                nextMove += PossiblePegColors[randomValue];
            }
        }

        Console.WriteLine("Current move " + nextMove);

        string pegs = CalculatePegs(nextMove);

        Console.WriteLine("Calculated pegs " + pegs);

        if (pegs == WON)
        {
            Console.WriteLine("AI guessed the code");
            return true;
        }

        string newMove = "";
        for (int i = 0; i < CodeSize; i++)
        {
            if (pegs[i] == BLACK)
            {
                newMove += nextMove[i];
            }
            else
            {
                int randomValue = Random.Next(0, PossiblePegColors.Length - 1);
                newMove += PossiblePegColors[randomValue];
            }
        }

        return AIGameLoop(newMove);
    }

    string ReadPegs()
    {
        string fullInput = "";
        for (int i = 0; i < CodeSize; i++)
        {
            Console.WriteLine("Peg " + (i + 1));
            string input = Console.ReadLine()!.ToUpper();

            if (!PossiblePegColors.Contains(input[0]))
            {
                Console.WriteLine("Peg does not exist");
                i--;
            }
            else
            {
                fullInput += input[0];
            }
        }
        return fullInput;
    }

    string CalculatePegs(string input)
    {
        if (input == Code)
        {
            return WON;
        }

        string pegs = "";
        for (int i = 0; i < CodeSize; i++)
        {
            if (input[i] == Code[i])
            {
                pegs += BLACK;
                continue;
            }

            for (int x = 0; x < CodeSize; x++)
            {
                if (input[i] == Code[x])
                {
                    pegs += WHITE;
                    break;
                }
            }

            if (pegs.Length < i + 1)
            {
                pegs += NOTHING;
            }
        }

        return pegs;
    }
}