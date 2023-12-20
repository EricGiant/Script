class Program
{
    static void Main(string[] args)
    {
        bool running = false;
        while(!running)
        {
            PathFinder pathFinder = new();
            running = pathFinder.Move();
        }

        Console.Read();
    }
}