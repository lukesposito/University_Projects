from actor import *


class Magic_Wall(Actor):
    def __init__(self, arena, x:int, y:int, w:int, h:int):
        self._x = x
        self._y = y
        self._w = w
        self._h = h
        self._attivato = False
        self._arena = arena
        arena.add(self)

    def move(self):
        pass

    def collide(self, other):
        pass

    def rect(self):
        return self._x, self._y, self._w, self._h

    def symbol(self):
        if(self._attivato == True):
            return 64, 641
        else:
            return 4, 641

class Magic_Wall_1(Actor):
    def __init__(self, arena, x:int, y:int, w:int, h:int):
        self._x = x
        self._y = y
        self._w = w
        self._h = h
        self._attivato = False
        self._arena = arena
        arena.add(self)

    def move(self):
        pass

    def collide(self, other):
        pass

    def rect(self):
        return self._x, self._y, self._w, self._h

    def symbol(self):
        if(self._attivato == True):
            return 64, 641
        else:
            return 4, 641


class Magic_Wall_2(Actor):
    def __init__(self, arena, x:int, y:int, w:int, h:int):
        self._x = x
        self._y = y
        self._w = w
        self._h = h
        self._attivato = False
        self._arena = arena
        arena.add(self)

    def move(self):
        pass

    def collide(self, other):
        pass

    def rect(self):
        return self._x, self._y, self._w, self._h

    def symbol(self):
        if(self._attivato == True):
            return 64, 641
        else:
            return 4, 641 
