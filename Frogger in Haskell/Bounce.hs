import System.Random
import Control.Monad

class (Show a) => Actor a where
    move :: String -> [a] -> a -> [a]
    rect :: a -> (Int, Int, Int, Int)  -- (x, y, w, h)

data Arena a = Arena { actors :: [a]
                     } deriving (Show)

tick :: (Actor a) => Arena a -> String -> Arena a
tick (Arena actors) keys = Arena $ concat (map (move keys actors) actors)

{-
operateArena :: (Actor a) => Arena a -> IO ()
operateArena arena = do
    print arena
    line <- getLine
    when (line /= "q") $ operateArena (tick arena line)-}


operateArena :: Arena BasicActor -> IO ()
operateArena arena = do
  let filteredArena = filterArena (not . isTurtleAndDead) arena
  print filteredArena
  line <- getLine
  when (line /= "q") $ operateArena (tick filteredArena line)

filterArena :: (BasicActor -> Bool) -> Arena BasicActor -> Arena BasicActor
filterArena pred (Arena actors) = Arena (filter pred actors)

isTurtleAndDead :: BasicActor -> Bool
isTurtleAndDead (Turtle _ _ dead) = dead
isTurtleAndDead _ = False

checkCollision :: (Actor a) => a -> a -> Bool
checkCollision a1 a2 = (rect a1) /= (rect a2) && y2 < y1+h1 && y1 < y2+h2 && x2 < x1+w1 && x1 < x2+w2
    where
        (x1, y1, w1, h1) = rect a1
        (x2, y2, w2, h2) = rect a2

collide :: BasicActor -> BasicActor -> BasicActor
collide (Ball x y dx dy _) (Ball x2 y2 _ _ _) = Ball (x-dx) (y-dy) (-dx) (-dy) False
collide (Ball x y dx dy kill) (Turtle x2 y2 _) = Ball (x-dx) (y-dy) (-dx) (-dy) True
collide (Turtle x y dead) Ball {} = Turtle x y True
collide a _ = a

maxX = 320
maxY = 240
actorW = 20
actorH = 20

data BasicActor = Ball { x :: Int, y :: Int, dx :: Int, dy :: Int, kill :: Bool}
                | Ghost { x :: Int, y :: Int, rnd :: StdGen}
                | Turtle { x :: Int, y :: Int, dead :: Bool} deriving (Show, Eq)


instance Actor BasicActor where
    rect (Ball x y _ _ _) = (x, y, actorW, actorH)
    rect (Ghost x y _) = (x, y, actorW, actorH)
    rect (Turtle x y _) = (x, y, actorW, actorH)

    move keys actors (Ball x y dx dy kill) = 
        let newX = clamp 0 (maxX - actorW) (x + dx)
            newY = clamp 0 (maxY - actorH) (y + dy)
            newDX = if newX == 0 || newX == (maxX - actorW) then -dx else dx
            newDY = if newY == 0 || newY == (maxY - actorH) then -dy else dy
            collidedWithTurtle = filter (checkCollision (Ball x y dx dy kill)) (filter (/= Ball x y dx dy kill) actors)
            collidedWithBall = filter (checkCollision (Ball x y dx dy kill)) (filter (\a -> a /= Ball x y dx dy kill && not (isTurtleAndDead a)) actors)
        in  if kill
                then [Ball newX newY newDX newDY True]
                else if not (null collidedWithTurtle)
                        then [foldl collide (Ball x y dx dy kill) collidedWithTurtle]
                        else if not (null collidedWithBall)
                                then [foldl collide (Ball x y dx dy kill) collidedWithBall]
                                else [Ball newX newY newDX newDY kill]

            {-isTurtle = filter (/= Ball x y dx dy kill) actors
        in if any (checkCollision (Ball x y dx dy kill)) isTurtle && not kill
            then do [head[collide (Ball x y dx dy kill) turtle | turtle <- isTurtle]]
        else [Ball newX newY newDX newDY kill]-}

    move keys actors (Ghost x y rnd) = do
        let (dx, newRnd) = randomR (-1, 1) rnd
            (dy, finalRnd) = randomR (-1, 1) newRnd
            x' = if x + dx >= 0 && x + dx <= maxX then x + dx else x
            y' = if y + dy >= 0 && y + dy <= maxY then y + dy else y
            (createBall, _) = randomR (0, 10) rnd :: (Int, StdGen)
            newBall = if createBall == 0 then [Ball x y 5 5 False] else []
        return (Ghost x' y' finalRnd) ++ newBall

    move keys actors (Turtle x y dead) =
        let balls = filter (/= Turtle x y dead) actors
        in if any (checkCollision (Turtle x y dead)) balls
            then [head [collide (Turtle x y dead) ball | ball <- balls]]
            else if dead
                then [Turtle x y dead] 
                else moveTurtle keys (Turtle x y dead)

        {-let collidedActors = filter (checkCollision (Turtle x y dead)) (filter (/= Turtle x y dead) actors)
        in  if dead
                then [Turtle x y dead]
                else if not (null collidedActors)
                        then [foldl collide (Turtle x y dead) collidedActors]
                        else moveTurtle keys (Turtle x y dead)-}

moveTurtle :: String -> BasicActor -> [BasicActor]
moveTurtle keys (Turtle x y dead)
  | keys == "s" = [Turtle x (clamp 0 maxY (y-5)) dead]
  | keys == "a" = [Turtle (clamp 0 maxX (x-5)) y dead]
  | keys == "w" = [Turtle x (clamp 0 maxY (y+5)) dead]
  | keys == "d" = [Turtle (clamp 0 maxX (x+5)) y dead]
  | otherwise = [Turtle x y dead]


clamp :: (Ord a) => a -> a -> a -> a
clamp minv maxv val = max minv (min val maxv)


main = do
    rnd <- newStdGen
    operateArena (Arena [Ball 200 100 5 5 False, Ball 230 120 (-5) (-5) False, Ghost 100 100 rnd, Turtle 160 120 False])
