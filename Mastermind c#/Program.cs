class Program
{
    static void Main(string[] args)
    {
        bool running = true;
        while (running)
        {
            Console.WriteLine("Do u want to play against AI? Y/N");
            string AIInput = "";
            while (AIInput == "")
            {
                AIInput = Console.ReadLine()!.ToUpper();
                if (AIInput != "Y" && AIInput != "N")
                {
                    Console.WriteLine("Wrong input");
                    AIInput = "";
                }
            }

            if (AIInput == "N")
            {
                _ = new BoardGame(true);
            }
            else
            {
                _ = new BoardGame();
            }

            Console.WriteLine("Do u want to play another game? Y/N");
            string anotherInput = "";
            while (anotherInput == "")
            {
                anotherInput = Console.ReadLine()!.ToUpper();
                if (anotherInput != "Y" && anotherInput != "N")
                {
                    Console.WriteLine("Wrong input");
                    anotherInput = "";
                }
            }

            if (anotherInput == "N")
            {
                running = false;
            }
        }
    }
}