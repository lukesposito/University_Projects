from actor import *


class mobile_platform(Actor):
    def __init__(self, arena, x:int, y:int, w:int, h:int):
        self._x = x
        self._y = y
        self._w = w
        self._h = h
        self._arena = arena
        arena.add(self)

    def move(self):
            self._y = (self._y - 3) % 300

    def collide(self, other):
        pass

    def rect(self):
        return self._x, self._y, self._w, self._h

    def symbol(self):
        return 63, 675
