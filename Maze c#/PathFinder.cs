class PathFinder
{
    const int TOP = 0, RIGHT = 1, BOTTOM = 2, LEFT = 3;
    public static bool CompleetedMaze {get; set;} = false;

    public int PositionY {get; set;} = 0;
    public int PositionX {get; set;} = 1;

    int OriginDirection {get; set;} = TOP;
    readonly Random Random = new();
    public bool Move()
    {
        List<int> possibleDirections = new();
        for(int i = 0; i < 4; i++)
        {
            if(i == OriginDirection)
            {
                continue;
            }

            string tile = "";
            switch(i)
            {
                case TOP:
                    tile =  Maze.MazeLayout[PositionY - 1, PositionX ];
                    break;
                case RIGHT:
                    tile =  Maze.MazeLayout[PositionY, PositionX + 1];
                    break;
                case BOTTOM:
                    tile =  Maze.MazeLayout[PositionY + 1, PositionX];
                    break;
                case LEFT:
                    tile =  Maze.MazeLayout[PositionY, PositionX - 1];
                    break;
            }
        
            if(tile == " ")
            {
                possibleDirections.Add(i);
            }
            else if(tile == "F")
            {
                return true;
            }
        }

        if(possibleDirections.Count == 0)
        {
            return false;
        }

        int direction = possibleDirections[Random.Next(0, possibleDirections.Count)];

        switch(direction)
        {
            case TOP:
                PositionY -= 1;
                OriginDirection = BOTTOM;
                break;
            case RIGHT:
                PositionX += 1;
                OriginDirection = LEFT;
                break;
            case BOTTOM:
                PositionY += 1;
                OriginDirection = TOP;
                break;
            case LEFT:
                PositionX -= 1;
                OriginDirection = RIGHT;
                break;
        }

        Maze.PrintMaze(PositionY, PositionX);

        return Move();
    }
}