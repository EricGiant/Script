class Maze
{
    public static readonly string[,] MazeLayout = {
        {"*", "S", "*", "*", "*", "*", "*", "*", "*", "*"},
        {"*", " ", "*", " ", " ", " ", " ", " ", " ", "*"},
        {"*", " ", "*", "*", " ", "*", "*", "*", " ", "*"},
        {"*", " ", "*", "*", "*", "*", " ", " ", " ", "*"},
        {"*", " ", "*", " ", " ", " ", "*", "*", " ", "*"},
        {"*", " ", "*", " ", "*", "*", "*", "*", " ", "*"},
        {"*", " ", "*", " ", "*", " ", " ", " ", " ", "*"},
        {"*", " ", "*", " ", "*", " ", "*", "*", " ", "*"},
        {"*", " ", " ", " ", " ", " ", " ", " ", " ", "*"},
        {"*", "*", "*", " ", "*", "*", " ", "*", "*", "*"},
        {"*", " ", "*", " ", " ", " ", " ", "*", " ", "F"},
        {"*", " ", " ", " ", "*", "*", " ", " ", " ", "*"},
        {"*", "*", "*", "*", "*", "*", "*", "*", "*", "*"},
    };
    
    public static void PrintMaze(int pathFinderPositionY, int pathFinderPositionX)
    {
        for(int y = 0; y < MazeLayout.GetLength(0); y++)
        {
            for(int x = 0; x < MazeLayout.GetLength(1); x++)
            {
                if(pathFinderPositionY == y && pathFinderPositionX == x)
                {
                    Console.Write("p");
                }
                else
                {
                    Console.Write(MazeLayout[y, x]);
                }
            }
            Console.WriteLine();
        }
        Console.WriteLine("----------");
    }
}