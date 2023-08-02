from game2d import *
from actor import Actor, Arena
from random import choice, randrange
from Wall_Trasparent import *
from Magic_Wall import *
from Mobile_Platform import *
from Flag import *

class Wall(Actor):
    def __init__(self, arena, x:int, y:int, w:int, h:int):
        self._x = x
        self._y = y
        self._w = w
        self._h = h
        self._arena = arena
        arena.add(self)

    def move(self):
        pass

    def collide(self, other):
        pass

    def rect(self):
        return self._x, self._y, self._w, self._h


class Castle(Actor):
    def __init__(self, arena, x:int, y:int, w:int, h:int):
        self._x = x
        self._y = y
        self._w = w
        self._h = h
        self._arena = arena
        arena.add(self)

    def move(self):
        pass

    def collide(self, other):
        pass

    def rect(self):
        return self._x, self._y, self._w, self._h

    def symbol(self):
        return 78, 1518

        
class Red_mushroom(Actor):
    W, H = 0, 0
    SPEED = 4
    MAX_SPEED = 6
    GRAVITY = 0.4
    CAMBIO = 1  #inverte posizione del fungo quando si avvicina al bordo della piattaforma
    
    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 1, 0
        self._arena = arena
        self._atterrato = False
        arena.add(self)

    def collide(self, other):
        pass
            
    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy
        if self._y < 0:
            self._y = 0
        elif self._y > arena_h - self.H:
            self._y = arena_h - self.H
            self._atterrato = True

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False

        if self.CAMBIO == 0:
            self._x -= self._dx
            if self._x == 290:
                self.CAMBIO = 1

        if self.CAMBIO == 1:
            self._x += self._dx
            if self._x == 403:
                self.CAMBIO = 0

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W

        
    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx

        if isinstance(other, Magic_Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx

        if isinstance(other, Magic_Wall_1):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx

        if isinstance(other, Magic_Wall_2):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx


    def go_left(self):
        self._dx = -self.SPEED
        
    def go_right(self):
        self._dx = +self.SPEED

    def stay(self):
        self._dx = 0

    def jump(self):
        if self._atterrato:
            self._dy = -self.SPEED * 2
            self._atterrato = False
    
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
        return 183, 670


class Green_mushroom(Actor):
    W, H = 0, 0
    SPEED = 4
    MAX_SPEED = 6
    GRAVITY = 0.4
    CAMBIO = 1 #inverte posizione del fungo quando si avvicina al bordo della piattaforma
    
    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 1, 0
        self._arena = arena
        self._atterrato = False
        arena.add(self)

    def collide(self, other):
        pass
            
    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy
        if self._y < 0:
            self._y = 0
        elif self._y > arena_h - self.H:
            self._y = arena_h - self.H
            self._atterrato = True

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False

        if self.CAMBIO == 0:
            self._x -= self._dx
            if self._x == 290:
                self.CAMBIO = 1

        if self.CAMBIO == 1:
            self._x += self._dx
            if self._x == 403:
                self.CAMBIO = 0

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W

        
    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx

        if isinstance(other, Magic_Wall_1):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx

        if isinstance(other, Magic_Wall_2):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx


    def go_left(self):
        self._dx = -self.SPEED
        
    def go_right(self):
        self._dx = +self.SPEED

    def stay(self):
        self._dx = 0

    def jump(self):
        if self._atterrato:
            self._dy = -self.SPEED * 2
            self._atterrato = False
    
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
        return 213, 670

class Star(Actor):
    W, H = 0, 0
    SPEED = 4
    MAX_SPEED = 6
    GRAVITY = 0.4
    CAMBIO = 1 #inverte posizione del fungo quando si avvicina al bordo della piattaforma
    
    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 1, 0
        self._arena = arena
        self._atterrato = False
        arena.add(self)

    def collide(self, other):
        pass
            
    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy
        if self._y < 0:
            self._y = 0
        elif self._y > arena_h - self.H:
            self._y = arena_h - self.H
            self._atterrato = True

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False

        if self.CAMBIO == 0:
            self._x -= self._dx
            if self._x == 290:
                self.CAMBIO = 1

        if self.CAMBIO == 1:
            self._x += self._dx
            if self._x == 403:
                self.CAMBIO = 0

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W

        
    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True


        if isinstance(other, Magic_Wall_2):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._x += self._dx


    def go_left(self):
        self._dx = -self.SPEED
        
    def go_right(self):
        self._dx = +self.SPEED

    def stay(self):
        self._dx = 0

    def jump(self):
        if self._atterrato:
            self._dy = -self.SPEED * 2
            self._atterrato = False
    
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
        return 4, 730


class CrazyGoomba(Actor):
    W, H = 16, 18
    SPEED = 4
    MAX_SPEED = 6
    GRAVITY = 0.7
    CAMBIO = 1  #inverte posizione del Goomba quando si avvicina al bordo della piattaforma
    
    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 1, 0
        self._arena = arena    
        self._animazione = 1 # cambia la sprite del Goomba
        self._alive = True
        self._atterrato = False
        self.this = False
        arena.add(self)

    def collide(self, other):
        pass
            
    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy
        if self._y < 0:
            self._y = 0
        elif self._y > arena_h - self.H:
            self._y = arena_h - self.H
            self._atterrato = True

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False


        if Goomba_1.CAMBIO == 1:
            Goomba_1._x -= Goomba_1._dx
            if Goomba_1._x == 20:
                Goomba_1.CAMBIO = 0

        if Goomba_1.CAMBIO == 0:
            Goomba_1._x += Goomba_1._dx
            if Goomba_1._x == 128:
                Goomba_1.CAMBIO = 1

        if Goomba_2.CAMBIO == 0:
            Goomba_2._x -= Goomba_2._dx
            if Goomba_2._x == 290:
                Goomba_2.CAMBIO = 1

        if Goomba_2.CAMBIO == 1:
            Goomba_2._x += Goomba_2._dx
            if Goomba_2._x == 403:
                Goomba_2.CAMBIO = 0

        

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W

        
    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True


    def go_left(self):
        self._dx = -self.SPEED
        
    def go_right(self):
        self._dx = +self.SPEED

    def stay(self):
        self._dx = 0

    def jump(self):
        if self._atterrato:
            self._dy = -self.SPEED * 2
            self._atterrato = False
    
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
        if self._animazione == 1:
            self._animazione = 0
            return 0, 379
        elif self._animazione == 0:
            self._animazione = 1
            return 29, 379
        
 
class CrazyKoopa(Actor):
    W, H = 18, 27
    SPEED = 3
    MAX_SPEED = 6
    GRAVITY = 0.7
    CAMBIO = 1 #inverte posizione del Koopa quando si avvicina al bordo della piattaforma
    
    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 1, 0
        self._arena = arena
        self._xs, self._ys = 179, 406 #coordinate sprite iniziali del Koopa
        self._atterrato = False
        self.alive = True
        arena.add(self)
            
    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy
        if self._y < 0:
            self._y = 0
        elif self._y > arena_h - self.H:
            self._y = arena_h - self.H
            self._atterrato = True

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False

        CAMBIO = randrange(2)
        if CAMBIO == 1:
            self._x -= self._dx
            self._xs, self._ys = 179, 406
            if self._x == 150:
                self._xs, self._ys = 211, 406
                CAMBIO = 0

        if CAMBIO == 0:
            self._x += self._dx
            self._xs, self._ys = 211, 406
            if self._x == 198:
                self._xs, self._ys = 179, 406
                CAMBIO = 1

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W
        
    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True


    def go_left(self):
        self._dx = -self.SPEED
        
    def go_right(self):
        self._dx = +self.SPEED

    def stay(self):
        self._dx = 0

    def jump(self):
        if self._atterrato:
            self._dy = -self.SPEED * 2
            self._atterrato = False
    
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
        return self._xs, self._ys
          
        

class Mario(Actor):
    W, H = 16, 18
    SPEED = 5
    MAX_SPEED = 8
    GRAVITY = 0.7

    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 0, 100
        self._atterrato = False
        self._alive = True
        self._big = False
        self._invincible = False
        self._animation = 0 #cambia lo sprite di Mario(usato anche per il movimento)
        self._count = 0 #contatore per l'invulnerabilità di Mario dopo che viene colpito
        self._fermo = False #utilizzato per bloccare il movimento di Mario da tastiera quando si attacca alla bandiera
        self._salto = 0 #cambia lo sprite di destra e di sinistra del salto di Mario
        self._win = False #condizione di vincita di Mario
        self._tempo_invul = 80
        self._tocco = False
        self._tocco1 = 0
        #self._c = 1
        self._arena = arena
        arena.add(self)

    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy

        if self._count > 0:
            self._count -= 1

        if self._tempo_invul > 0 and self._invincible == True:
            self._tempo_invul -= 1
            if self._tempo_invul == 0:
                self._invincible = False
                
        
        if self._y >= arena_h - self.H and self._win == False:
            self._alive = False

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False
        
        self._x += self._dx

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W

    def go_left(self):
        self._salto = 1
##        if self._invincible == True:
##            if self._c < 8:
##                self._c = 8
##            if self._c < 14:
##                self._c += 1
##            elif self._c > 9:
##                self._c -= 1
        
        if self._animation < 4:
            self._animation = 4
        if self._animation < 7:
            self._animation += 1
        elif self._animation > 5:
            self._animation -= 1
        self._dx = -self.SPEED
        
    def go_right(self):
        self._salto = 2
##        if self._invincible == True:
##            if self._c > 8:
##                self._c = 2
##            if self._c < 8:
##                self._c += 1
##            elif self._c > 3:
##                self._c -= 1
        
        if self._animation >= 4:
            self._animation = 0
        if self._animation < 3:
            self._animation += 1
        elif self._animation > 1:
            self._animation -= 1
        self._dx = +self.SPEED

    def stay(self):
##        if self._invincible == True:
##            if self._c >= 2:
##                self._c = 1
##            elif self._c == 1:
##                self._c = 2 
        self._animation = 0
        self._salto = 0
        self._dx = 0 

    def jump(self):
            self._animation = 4
            if self._atterrato:
                self._dy = -self.SPEED * 2
                self._atterrato = False

    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True

        if isinstance(other, Flag):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0:
                self._fermo = True
                self._tocco = True

        if isinstance(other, Block_Flag):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._fermo = True
                self._x = other._x
                self._y = other._y
                self._win = True

        if isinstance(other, mobile_platform):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True

        if isinstance(other, Magic_Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
            if move[1] > 0 and Blocco_sorpresa._attivato == False:
                Blocco_sorpresa._attivato = True
                Fungo_Rosso.W, Fungo_Rosso.H = 19, 19 
                Fungo_Rosso._x, Fungo_Rosso._y = 310, 181
                arena.add(Fungo_Rosso)
                

        if isinstance(other, Magic_Wall_1):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True

        if isinstance(other, Magic_Wall_2):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
            if move[1] > 0 and Blocco_sorpresa2._attivato == False:
                Blocco_sorpresa2._attivato = True
                Stella.W, Stella.H = 17, 19 
                Stella._x, Stella._y = 370, 181
                arena.add(Stella)

        
        if isinstance(other, CrazyGoomba):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] > 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] < 0 and self._count == 0 and self._invincible == False:
                mario._alive = False
            elif move[0] > 0 and self._count == 0 and self._invincible == False:
                mario._alive = False
            if mario._x < 250:
                Goomba_1.this = True
                if move[0] < 0 and self._invincible == True and Goomba_1.this == True:
                    arena.remove(Goomba_1)
                elif move[0] > 0 and self._invincible == True and Goomba_1.this == True:
                    arena.remove(Goomba_1)
                elif move[1] < 0 and Goomba_1.this == True:
                    self._dy = 1
                    self._atterrato = True
                    mario._alive = True
                    arena.remove(Goomba_1)
                    self._dy = self._dy - 7
            if mario._x > 250:
                Goomba_2.this = False
                if move[0] < 0 and self._invincible == True and Goomba_2.this == False:
                    arena.remove(Goomba_2)
                elif move[0] > 0 and self._invincible == True and Goomba_2.this == False:
                    arena.remove(Goomba_2)
                elif move[1] < 0 and Goomba_2.this == False:
                    self._dy = 1
                    self._atterrato = True
                    mario._alive = True
                    arena.remove(Goomba_2)
                    self._dy = self._dy - 7

            
                    

        if isinstance(other, CrazyKoopa):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)] 
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] > 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] < 0 and self._invincible == False and self._count == 0:
                mario._alive = False
            elif move[0] > 0 and self._invincible == False and self._count == 0:
                mario._alive = False
            elif move[0] < 0 and self._invincible == True:
                arena.remove(Koopa)
            elif move[0] > 0 and self._invincible == True:
                arena.remove(Koopa)
            elif move[1] < 0:
                self._dy = 1
                self._atterrato = True
                mario._alive = True
                arena.remove(Koopa)
                self._dy = self._dy - 7

        if isinstance(other, Red_mushroom):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0:
                self._big = True
                self.W = 18
                self.H = 35
                arena.remove(Fungo_Rosso)
            if move[0] > 0:
                self._big = True
                self.W = 18
                self.H = 35
                arena.remove(Fungo_Rosso)
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._big = True
                self.W = 18
                self.H = 35
                arena.remove(Fungo_Rosso)

        if isinstance(other, Star):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0:
                self._invincible = True
                arena.remove(Stella)
            if move[0] > 0:
                self._invincible = True
                arena.remove(Stella)
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._invincible = True
                arena.remove(Stella)
                
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
          if self._big == True:
              if self._invincible == True and self._tocco == False:
                  if self._animation == 0:
                      return 208, 121
                  elif self._animation == 1:
                      return 237, 121
                  elif self._animation == 2:
                      return 262, 121
                  elif self._animation == 3:
                      return 288, 121
                  elif self._animation == 4:
                      if self._salto == 1:
                          return 26, 121
                      elif self._salto == 2 or self._salto == 0:
                          return 361, 120
                  elif self._animation == 5:
                      return 151, 121
                  elif self._animation == 6:
                      return 127, 121
                  elif self._animation == 7:
                      return 101, 121

              if self._invincible == False and self._tocco == False:
                  if self._animation == 0:
                      return 208, 50
                  elif self._animation == 1:
                      return 238, 50
                  elif self._animation == 2:
                      return 268, 50
                  elif self._animation == 3:
                      return 298, 50
                  elif self._animation == 4:
                      if self._salto == 1:
                          return 29, 51
                      elif self._salto == 2 or self._salto == 0:
                          return 358, 51 
                  elif self._animation == 5:
                      return 149, 51
                  elif self._animation == 6:
                      return 121, 51
                  elif self._animation == 7:
                      return 89, 52

              if self._tocco == True:
                  if self._tocco1 == 0:
                      return 363, 88
                  if self._tocco1 == 1:
                      return 389, 88
          else:
              if self._tocco == False:
                  if self._animation == 0:
                      return 210, 0 
                  elif self._animation == 1:
                      return 240, 0
                  elif self._animation == 2:
                      return 270, 0
                  elif self._animation == 3:
                      return 300, 0
                  elif self._animation == 4:
                      if self._salto == 1:
                          return 28, 0
                      elif self._salto == 2 or self._salto == 0:
                          return 358, 0
                  elif self._animation == 5:
                      return 150, 0
                  elif self._animation == 6:
                      return 120, 0
                  elif self._animation == 7:
                      return 90, 0

              if self._tocco == True:
                  if self._tocco1 == 0:
                        self._tocco1 = 1
                        return 330, 29
                  if self._tocco1 == 1:
                        self._tocco1 = 0
                        return 360, 29
        
    


class Luigi(Actor):
    W, H = 16, 18
    SPEED = 5
    MAX_SPEED = 8
    GRAVITY = 0.7

    def __init__(self, arena, x:int, y:int):
        self._x, self._y = x, y
        self._dx, self._dy = 0, 100
        self._atterrato = False
        self._alive = True
        self._big = False
        self._invincible = False
        self._animation = 0 #cambia lo sprite di Luigi(usato anche per il movimento)
        self._count = 0 #contatore per l'invulnerabilità di Luigi
        self._fermo = False #utilizzato per bloccare il movimento di Luigi da tastiera quando si attacca alla bandiera
        self._salto = 0 #cambia lo sprite di destra e di sinistra del salto di Luigi
        self._win = False #condizione di vincita di Luigi
        self._arena = arena

        self._arena = arena
        arena.add(self)

    def move(self):
        arena_w, arena_h = self._arena.size()
        self._y += self._dy

        while(self._count > 0):
            self._count = self._count - 1
        
        if self._y >= arena_h - self.H and self._win == False:
            self._alive = False

        if not self._atterrato:
            self._dy = self._dy + self.GRAVITY
            self._dy = min(self._dy, self.MAX_SPEED)

        self._atterrato = False

        self._x += self._dx

        if self._x < 0:
            self._x = 0
        elif self._x > arena_w - self.W:
            self._x = arena_w - self.W

    def go_left(self):
        self._salto = 1
        if self._animation < 4:
            self._animation = 4
        if self._animation < 7:
            self._animation += 1
        elif self._animation > 5:
            self._animation -= 1
        self._dx = -self.SPEED
        
    def go_right(self):
        self._salto = 2
        if self._animation >= 4:
            self._animation = 0
        if self._animation < 3:
            self._animation += 1
        elif self._animation > 1:
            self._animation -= 1
        self._dx = +self.SPEED

    def stay(self):
        self._animation = 0
        self._salto = 0
        self._dx = 0 

    def jump(self):
        self._animation = 4
        if self._atterrato:
            self._dy = -self.SPEED * 2
            self._atterrato = False

    def collide(self, other):
        if isinstance(other, Wall):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True

        if isinstance(other, Flag):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0:
                self._fermo = True

        if isinstance(other, Block_Flag):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._fermo = True
                self._x = other._x
                self._y = other._y
                self._win = True

        if isinstance(other, mobile_platform):
            bx, by, bw, bh = self.rect()  
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                

        if isinstance(other, Magic_Wall):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True

        if isinstance(other, Magic_Wall_1):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
            if move[1] > 0 and Blocco_sorpresa1._attivato == False:
                Blocco_sorpresa1._attivato = True
                Fungo_Verde.W, Fungo_Verde.H = 19, 19 
                Fungo_Verde._x, Fungo_Verde._y = 340, 181
                arena.add(Fungo_Verde)

        if isinstance(other, Magic_Wall_2):
            bx, by, bw, bh = self.rect() 
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
            if move[1] > 0 and Blocco_sorpresa2._attivato == False:
                Blocco_sorpresa2._attivato = True
                Stella.W, Stella.H = 17, 19 
                Stella._x, Stella._y = 370, 181
                arena.add(Stella)

        if isinstance(other, CrazyGoomba):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect()
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] > 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] < 0 and self._count == 0 and self._invincible == False:
                luigi._alive = False
            elif move[0] > 0 and self._count == 0 and self._invincible == False:
                luigi._alive = False
            if luigi._x < 250:
                Goomba_1.this = True
                if move[0] < 0 and self._invincible == True and Goomba_1.this == True:
                    arena.remove(Goomba_1)
                elif move[0] > 0 and self._invincible == True and Goomba_1.this == True:
                    arena.remove(Goomba_1)
                elif move[1] < 0 and Goomba_1.this == True:
                    self._dy = 1
                    self._atterrato = True
                    luigi._alive = True
                    arena.remove(Goomba_1)
                    self._dy = self._dy - 7
            if luigi._x > 250:
                Goomba_2.this = False
                if move[0] < 0 and self._invincible == True and Goomba_2.this == False:
                    arena.remove(Goomba_2)
                elif move[0] > 0 and self._invincible == True and Goomba_2.this == False:
                    arena.remove(Goomba_2)
                elif move[1] < 0 and Goomba_2.this == False:
                    self._dy = 1
                    self._atterrato = True
                    luigi._alive = True
                    arena.remove(Goomba_2)
                    self._dy = self._dy - 7

        if isinstance(other, CrazyKoopa):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by)] 
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] > 0 and self._big == True and self._count == 0 and self._invincible == False:
                self._big = False
                self.W = 16
                self.H = 18
                self._count = 100
            elif move[0] < 0 and self._invincible == False and self._count == 0:
                luigi._alive = False
            elif move[0] > 0 and self._invincible == False and self._count == 0:
                luigi._alive = False
            elif move[0] < 0 and self._invincible == True:
                arena.remove(Koopa)
            elif move[0] > 0 and self._invincible == True:
                arena.remove(Koopa)
            elif move[1] < 0:
                self._dy = 1
                self._atterrato = True
                luigi._alive = True
                arena.remove(Koopa)
                self._dy = self._dy - 7

        if isinstance(other, Green_mushroom):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0:
                self._big = True
                self.W = 18
                self.H = 35
                arena.remove(Fungo_Verde)
            if move[0] > 0:
                self._big = True
                self.W = 18
                self.H = 35
                arena.remove(Fungo_Verde)
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._big = True
                self.W = 18
                self.H = 35
                arena.remove(Fungo_Verde)

        if isinstance(other, Star):
            bx, by, bw, bh = self.rect()
            wx, wy, ww, wh = other.rect() 
            borders_distance = [(wx - bw - bx, 0), (wx + ww - bx, 0),
                                (0, wy - bh - by), (0, wy + wh - by)]
            move = min(borders_distance, key=lambda m: abs(m[0] + m[1]))
            self._x += move[0]
            self._y += move[1]
            if move[0] < 0:
                self._invincible = True
                arena.remove(Stella)
            if move[0] > 0:
                self._invincible = True
                arena.remove(Stella)
            if move[1] < 0:
                self._dy = 1
                self._atterrato = True
                self._invincible = True
                arena.remove(Stella)

                
    def rect(self):
        return self._x, self._y, self.W, self.H

    def symbol(self):
        if self._big == True:
              if self._animation == 0:
                  return 208, 239
              elif self._animation == 1:
                  return 238, 239
              elif self._animation == 2:
                  return 268, 239
              elif self._animation == 3:
                  return 298, 239
              elif self._animation == 4:
                  if self._salto == 1:
                      return 29, 239 
                  elif self._salto == 2 or self._salto == 0:
                      return 358, 239
              elif self._animation == 5:
                  return 149, 239
              elif self._animation == 6:
                  return 120, 239
              elif self._animation == 7:
                  return 89, 239
                  
        else:
              if self._animation == 0:
                  return 210, 187 
              elif self._animation == 1:
                  return 239, 187
              elif self._animation == 2:
                  return 271, 187
              elif self._animation == 3:
                  return 299, 187
              elif self._animation == 4:
                  if self._salto == 1:
                      return 27, 187
                  elif self._salto == 2 or self._salto == 0:
                      return 358, 187
              elif self._animation == 5:
                  return 149, 187
              elif self._animation == 6:
                  return 120, 187
              elif self._animation == 7:
                  return 88, 187


def keydown(event):
    code = event.code
    if(code == "ArrowLeft" and mario._alive == True and mario._fermo == False):
        mario.go_left()
    elif(code == "ArrowRight" and mario._alive == True and mario._fermo == False):
        mario.go_right()
    elif(code == "Space" and mario._alive == True and mario._fermo == False):
        mario.jump()
    elif(code == "KeyA" and luigi._alive == True and luigi._fermo == False):
        luigi.go_left()
    elif(code == "KeyD" and luigi._alive == True and luigi._fermo == False):
        luigi.go_right()
    elif(code == "KeyW" and luigi._alive == True and luigi._fermo == False):
        luigi.jump()
    
    

def keyup(event):
    code = event.code
    if(code in ("ArrowLeft","ArrowRight")and mario._alive == True and mario._fermo == False):
        mario.stay()
    elif(code in ("KeyA","KeyD") and luigi._alive == True and luigi._fermo == False):
        luigi.stay()
    

  
    
def update():
    global vx, vy
    aW, aH = arena.size()
    image_blit(canvas, Background, (0, 0), area=(vx, vy, 600, 300))
    arena.move_all()
    if mario._x > 300 and luigi._x > 300:
        vx = min(vx + mario.SPEED, aW - 600)
    if mario._x >= line_flag._x:
        mario._x = line_flag._x
    elif luigi._x >= line_flag._x:
        luigi._x = line_flag._x
    #if mario._x >= luigi._x + 120:
    #    mario._x = luigi._x + 120
    
        
    for a in arena.actors():
        if isinstance(a, Wall):
            x1, y1, w1, h1 = Platform_1.rect()
            x2, y2, w2, h2 = Platform_2.rect()
            x3, y3, w3, h3 = Platform_3.rect()
            x4, y4, w4, h4 = Platform_4.rect()
            x5, y5, w5, h5 = Wall_1.rect()
            x6, y6, w6, h6 = Wall_2.rect()
            x7, y7, w7, h7 = Wall_3.rect()
            x8, y8, w8, h8 = Blocco.rect()
            x9, y9, w9, h9 = Blocco1.rect()
            image_blit(canvas, Sprites, (x1- vx,y1), (0, 887, w1, h1))
            image_blit(canvas, Sprites, (x2- vx,y2), (221, 849, w2, h2))
            image_blit(canvas, Sprites, (x3- vx,y3), (0, 887, w3, h3))
            image_blit(canvas, Sprites, (x4- vx,y4), (171, 986, w4, h4))
            image_blit(canvas, Sprites, (x5- vx,y5), (16, 901, w5, h5))
            image_blit(canvas, Sprites, (x6- vx,y6), (237, 862, w6, h6)) 
            image_blit(canvas, Sprites, (x7- vx,y7), (16, 901, w7, h7))
            image_blit(canvas, sprites_blocchi, (x8- vx,y8), (372, 46, w8, h8))
            image_blit(canvas, sprites_blocchi, (x9- vx,y9), (372, 46, w8, h8))
            
        elif(mario._alive == False):
            xm, ym, wm, hm = mario.rect()
            arena.remove(Platform_2)
            arena.remove(Wall_2)
            arena.remove(Platform_1)
            arena.remove(Wall_1)
            image_blit(canvas, Game_over, (0,0))
            image_blit(canvas, Sprites, (xm, ym), (0, 14, wm, hm))
                
        elif(luigi._alive == False):
            xl, yl, wl, hl = luigi.rect()
            arena.remove(Platform_2)
            arena.remove(Wall_2)
            arena.remove(Platform_1)
            arena.remove(Wall_1)
            image_blit(canvas, Game_over, (0,0))
            image_blit(canvas, Sprites, (xl, yl), (0, 203, wl, hl))

        elif mario._win == True or luigi._win == True:
            image_blit(canvas, Victory, (0,0))
                
        else:
            x, y, w, h = a.rect()
            xs, ys = a.symbol()
            image_blit(canvas, Sprites, (x-vx, y), (xs, ys, w, h))
            
            

        
            

arena = Arena(900, 300)
Platform_1 = Wall(arena, 20, 260, 130, 20)
Platform_2 = Wall(arena, 150, 190, 68, 18)
Platform_3 = Wall(arena, 290, 260, 130, 20)
Platform_4 = Wall(arena, 5, 180, 81, 18)
Wall_1 = Wall(arena, 35, 280, 102, 80)
Wall_2 = Wall(arena, 165, 209, 38, 120)
Wall_3 = Wall(arena, 305, 280, 102, 80)
Wall_4 = Wall_Trasparent(arena, 37, 196, 16, 66)
Blocco_sorpresa = Magic_Wall(arena, 310, 200, 16, 16)
Blocco = Wall(arena, 325, 200, 16, 16)
Blocco_sorpresa1 = Magic_Wall_1(arena, 340, 200, 16, 16)
Blocco1 = Wall(arena, 355, 200, 16, 16)
Blocco_sorpresa2 = Magic_Wall_2(arena, 370, 200, 16, 16)
barra = mobile_platform(arena, 520, 5, 47, 9)
line_flag = Flag(arena, 706, 150, 6, 144)
block_flag = Block_Flag(arena, 700, 284, 17, 16)
castle = Castle(arena, 750, 144, 149, 177)
mario = Mario(arena, 65, 70)
luigi = Luigi(arena, 55, 55)
Fungo_Rosso = Red_mushroom(arena, 400, 181)
Fungo_Verde = Green_mushroom(arena, 400, 181)
Stella = Star(arena, 400, 181)
Goomba_1 = CrazyGoomba(arena, 140, 210)
Goomba_2 = CrazyGoomba(arena, 305, 250)
Koopa = CrazyKoopa(arena, 170, 150)
vx, vy, x, y = 0, 0, 0, 0
canvas = canvas_init((600, 300))
Sprites = image_load("smb_sprites.png")
sprites_blocchi = image_load("smb1_misc_sprites.png")
Background = image_load("Sfondo.png")
Game_over = image_load("GameOver.png")
Victory = image_load("win.png")
doc.onkeydown = keydown
doc.onkeyup = keyup
timer.set_interval(update, 1000 // 30)
