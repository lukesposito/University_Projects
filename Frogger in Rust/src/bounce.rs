use std::any::Any;
use std::cmp::{min, max};

use crate::actor::*;
use crate::rand::*;

pub struct Turtle {
    pos: Pt,
    step: Pt,
    size: Pt,
    speed: i32,
}
impl Turtle {
    pub fn new(pos: Pt, speed: i32) -> Turtle {
        Turtle{pos: pos, step: pt(1, 0), size: pt(96 , 23), speed: speed}
    }
}
impl Actor for Turtle {
    fn act(&mut self, arena: &mut ArenaStatus) {
        let arena_out_br = arena.size().x + 300;
        let arena_out_bl = -300;
        if self.pos.x < arena_out_bl {
             self.pos.x = arena_out_br
        }
        else if self.pos.x > arena_out_br {
             self.pos.x = arena_out_bl
        }
        self.step.x = self.speed;
        self.pos = self.pos + self.step;
    }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn sprite(&self) -> Option<Pt> { Some(pt(192, 132)) }
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { self.speed }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}


pub struct Crocodile {
    pos: Pt,
    step: Pt,
    size: Pt,
    speed: i32,
}
impl Crocodile {
    pub fn new(pos: Pt, speed: i32) -> Crocodile {
        Crocodile{pos: pos, step: pt(1, 0), size: pt(94 , 31), speed: speed}
    }
}
impl Actor for Crocodile {
    fn act(&mut self, arena: &mut ArenaStatus) {
        let arena_out_br = arena.size().x + 300;
        let arena_out_bl = -300;
        if self.pos.x < arena_out_bl {
             self.pos.x = arena_out_br
        }
        else if self.pos.x > arena_out_br {
             self.pos.x = arena_out_bl
        }

        self.step.x = self.speed;
        self.pos = self.pos + self.step;
    }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn sprite(&self) -> Option<Pt> { 
        Some(pt(192, 224)) 
    }
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { self.speed }
    fn pos_body(&self) -> i32 { self.pos.x }
    fn pos_head(&self) -> i32 { self.pos.x + 44}
}

pub struct Car {
    pos: Pt,
    step: Pt,
    size: Pt,
    speed: i32,
}
impl Car {
    pub fn new(pos: Pt, speed: i32) -> Car {
        Car{pos: pos, step: pt(1, 0), size: pt(35, 32), speed: speed}
    }
}
impl Actor for Car {
    fn act(&mut self, arena: &mut ArenaStatus) {
        let arena_out_br = arena.size().x + 300;
        let arena_out_bl = -300;
        if self.pos.x < arena_out_bl {
             self.pos.x = arena_out_br
        }
        else if self.pos.x > arena_out_br {
             self.pos.x = arena_out_bl
        }

        self.step.x = self.speed;
        self.pos = self.pos + self.step;
    }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn sprite(&self) -> Option<Pt> {Some(pt(191, if self.speed >= 0 {1} else {33}))}
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { self.speed }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}

pub struct Camion {
    pos: Pt,
    step: Pt,
    size: Pt,
    speed: i32,
}
impl Camion {
    pub fn new(pos: Pt, speed: i32) -> Camion {
        Camion{pos: pos, step: pt(1, 0), size: pt(60, 32), speed: speed}
    }
}
impl Actor for Camion {
    fn act(&mut self, arena: &mut ArenaStatus) {
        let arena_out_br = arena.size().x + 300;
        let arena_out_bl = -300;
        if self.pos.x < arena_out_bl {
             self.pos.x = arena_out_br
        }
        else if self.pos.x > arena_out_br {
             self.pos.x = arena_out_bl
        }

        self.step.x = self.speed;
        self.pos = self.pos + self.step;
    }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn sprite(&self) -> Option<Pt> { Some(pt(if self.speed >= 0 {257} else {190}, 66))}
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { self.speed }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}

pub struct Trunk {
    pos: Pt,
    step: Pt,
    size: Pt,
    speed: i32,
}
impl Trunk {
    pub fn new(pos: Pt, speed: i32) -> Trunk {
        Trunk{pos: pos, step: pt(1, 0), size: pt(96, 22), speed: speed}
    }
}
impl Actor for Trunk {
    fn act(&mut self, arena: &mut ArenaStatus) {
        let arena_out_br = arena.size().x + 300;
        let arena_out_bl = -300;
        if self.pos.x < arena_out_bl {
             self.pos.x = arena_out_br
        }
        else if self.pos.x > arena_out_br {
             self.pos.x = arena_out_bl
        }

        self.step.x = self.speed;
        self.pos = self.pos + self.step;
    }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn sprite(&self) -> Option<Pt> { 
        Some(pt(215, 100))
    }
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { self.speed }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}

pub struct River {
    pos: Pt,
    size: Pt
}
impl River {
    pub fn new(pos: Pt) -> River {
        River{pos: pos, size: pt(680, 180)}
    }
}
impl Actor for River {
    fn act(&mut self, _arena: &mut ArenaStatus) { }
    fn sprite(&self) -> Option<Pt> { None }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { 0 }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}


pub struct FinishLine{
    pos: Pt,
    size: Pt,
}
impl FinishLine {
    pub fn new(pos: Pt) -> FinishLine {
        FinishLine{pos: pos, size: pt (640, 10)}
    }
}
impl Actor for FinishLine {
    fn act(&mut self, _arena: &mut ArenaStatus) { }
    fn sprite(&self) -> Option<Pt> { None }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn alive(&self) -> bool { true }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { 0 }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}


pub struct Frog {
    pos: Pt,
    step: Pt,
    size: Pt,
    speed: i32,
    lives: i32,
    blinking: i32,
    on_top: i32,
    checkcollision_turtle : bool,
    checkcollision_trunk : bool,
    checkcollision_crocodile: bool,
    checkcollision_river: bool,
    check_finishline: bool,
    body_crocodile: bool,
    mouth_crocodile: bool,
}
impl Frog {
    pub fn new(pos: Pt) -> Frog {
        Frog{pos: pos, step: pt(0, 0), size: pt(28, 30),
            speed: 10, lives: 3, blinking: 0, on_top: 0, checkcollision_turtle: false, checkcollision_trunk: false, checkcollision_crocodile: false, checkcollision_river: false, check_finishline:false, body_crocodile:false, mouth_crocodile:false}
    }
    fn lives(&self) -> i32 { self.lives }
}
impl Actor for Frog {

    fn act(&mut self, arena: &mut ArenaStatus) {
            self.checkcollision_turtle = false;
            self.checkcollision_trunk = false;
            self.checkcollision_crocodile = false;
            self.checkcollision_river = false;
            self.check_finishline = false;
            self.body_crocodile = false;
            self.mouth_crocodile = false;
            for other  in arena.collisions() {
                if let Some(_winbox) = other.as_any().downcast_ref::<FinishLine>() {
                    self.check_finishline = true;
                    
                }
                if let Some(_) = other.as_any().downcast_ref::<Turtle>() {
                    self.checkcollision_turtle = true;
                    self.on_top = other.speed();
                }
                if let Some(_) = other.as_any().downcast_ref::<Crocodile>() {
                    self.checkcollision_crocodile = true;
                    if self.pos.x >= other.pos_body() && self.pos.x < other.pos_head() {
                        self.on_top = other.speed();
                        self.body_crocodile = true;
                    }
                    else if self.pos.x >= other.pos_head() {
                        self.mouth_crocodile = true;
                        self.blinking = 20;
                        self.lives -= 1;
                        self.pos = pt(arena.size().x/2, arena.size().y - 32);
                    }
                }
                if let Some(_) = other.as_any().downcast_ref::<Car>() {
                    self.blinking = 20;
                    self.lives -= 1;
                    self.pos = pt(arena.size().x/2, arena.size().y - 32);
                }
                if let Some(_) = other.as_any().downcast_ref::<Camion>() {
                    self.blinking = 20;
                    self.lives -= 1;
                    self.pos = pt(arena.size().x/2, arena.size().y - 32);
                }
                if let Some(_) = other.as_any().downcast_ref::<Trunk>() {
                    self.checkcollision_trunk = true;
                    self.on_top = other.speed();
                }
                if let Some(_) = other.as_any().downcast_ref::<River>() {
                    self.checkcollision_river = true;
                }
                

            
        }
        if  !self.checkcollision_crocodile && !self.mouth_crocodile && !self.body_crocodile && !self.checkcollision_trunk && !self.checkcollision_turtle && self.check_finishline && !self.checkcollision_river{
            self.pos = pt(arena.size().x/2, arena.size().y - 32);
        }
        else if  !self.checkcollision_crocodile && !self.mouth_crocodile && !self.body_crocodile && !self.checkcollision_trunk && !self.checkcollision_turtle && !self.check_finishline && self.checkcollision_river{
            self.blinking = 20;
            self.lives -= 1;
            self.pos = pt(arena.size().x/2, arena.size().y - 32);
        }
        else if self.checkcollision_crocodile && self.mouth_crocodile && self.body_crocodile && !self.checkcollision_trunk && !self.checkcollision_turtle && !self.check_finishline && !self.checkcollision_river{
            self.blinking = 20;
            self.lives -= 1;
            self.pos = pt(arena.size().x/2, arena.size().y - 32);
        }
        else if self.checkcollision_crocodile && self.mouth_crocodile && !self.body_crocodile && !self.checkcollision_trunk && !self.checkcollision_turtle && !self.check_finishline && !self.checkcollision_river{
            self.blinking = 20;
            self.lives -= 1;
            self.pos = pt(arena.size().x/2, arena.size().y - 32);
        }
        let keys = arena.current_keys();
        self.step = pt(0, 0);

            if keys.contains(&"ArrowUp") {
                self.step.y = -self.speed;
                self.step.x = 0;
            } else if keys.contains(&"ArrowDown") {
                self.step.y = self.speed;
                self.step.x = 0;
            }
            if keys.contains(&"ArrowLeft") {
                self.step.x = -self.speed;
                self.step.y = 0;
            } else if keys.contains(&"ArrowRight") {
                self.step.x = self.speed;
                self.step.y = 0;
            }
            
        self.pos.x += self.step.x;
        self.pos.y += self.step.y;
        self.pos.x += self.on_top;
        
        if  !self.checkcollision_crocodile && !self.mouth_crocodile && !self.body_crocodile && !self.checkcollision_trunk && !self.checkcollision_turtle {
            self.on_top = 0;
        }


        let scr = arena.size() - self.size;
        if !self.checkcollision_river && !self.checkcollision_crocodile && !self.mouth_crocodile && !self.body_crocodile && !self.checkcollision_trunk && !self.checkcollision_turtle && !self.check_finishline {
            self.pos.x = min(max(self.pos.x, 0), scr.x);  // clamp
            self.pos.y = min(max(self.pos.y, 0), scr.y);  // clamp
        }

        if self.pos.x > arena.size().x || self.pos.x < -32 {
            self.blinking = 20;
            self.lives -= 1;
            self.pos = pt(arena.size().x/2, arena.size().y - 32);
        }
        
        self.blinking = max(self.blinking - 1, 0);

    }
    fn pos(&self) -> Pt { self.pos }
    fn size(&self) -> Pt { self.size }
    fn sprite(&self) -> Option<Pt> {
        if self.blinking > 0 && (self.blinking / 2) % 2 == 0 { None } 
        else { Some(pt(0, 0)) }
    }
    fn alive(&self) -> bool { self.lives > 0 }
    fn as_any(&self) -> &dyn Any { self }
    fn speed(&self) -> i32 { self.speed }
    fn pos_body(&self) -> i32 { 0 }
    fn pos_head(&self) -> i32 { 0 }
}


pub struct BounceGame {
    arena: Arena,
    playtime: i32
}
impl BounceGame {
    /*fn randpt(size: Pt) -> Pt {
        let mut p = pt(randint(0, size.x), randint(0, size.y));
        while (p.x - size.x / 2).pow(2) + (p.y - size.y / 2).pow(2) < 10000 {
            p = pt(randint(0, size.x), randint(0, size.y));
        }
        return p;
    }*/
    pub fn new(size: Pt, nvehicles: i32, nactor: i32) -> BounceGame {
        let mut arena = Arena::new(size);
        //let size = size - pt(20, 20);
        arena.spawn(Box::new(River::new(pt(-32,32))));
        arena.spawn(Box::new(FinishLine::new(pt(-32,10))));

        for i in 0..4 {
            let mut newpos = 0;
            let dir_vehicle = randint(0, 1);
            let speed = randint(1, 4);
            for _ in 0..nvehicles {
                let type_vehicle = randint(0, 1);
                if dir_vehicle == 1 && type_vehicle == 0{
                    arena.spawn(Box::new(Car::new(pt(newpos, 395-(40*i)), speed)));
                    newpos = newpos + randint(90, 270);
                } else if dir_vehicle == 1 && type_vehicle == 1 {
                    arena.spawn(Box::new(Camion::new(pt(newpos, 395-(40*i)), speed)));
                    newpos = newpos + randint(90, 270);
                } else if dir_vehicle == 0 && type_vehicle == 0 {
                    arena.spawn(Box::new(Car::new(pt(newpos, 395-(40*i)), -speed)));
                    newpos = newpos + randint(90, 270);
                } else if dir_vehicle == 0 && type_vehicle == 1 {
                    arena.spawn(Box::new(Camion::new(pt(newpos, 395-(40*i)), -speed)));
                    newpos = newpos + randint(90, 270);
                }
            }
        }
        for i in 0..5 {
            let mut newpos = 0;
            let dir = randint(0, 1);
            let speed = randint(1, 2);
            for _ in 0..nactor {
                let type_actor = randint(0, 2);
                if dir == 1 && type_actor == 0{
                    arena.spawn(Box::new(Trunk::new(pt(newpos, 210-(40*i)), speed)));
                    newpos = newpos + randint(100, 250);
                } else if dir == 1 && type_actor == 1{
                    arena.spawn(Box::new(Crocodile::new(pt(newpos, 200-(40*i)), speed)));
                    newpos = newpos + randint(100, 250);
                } else if dir == 1 && type_actor == 2{
                    //arena.spawn(Box::new(Turtle::new(pt(newpos, 196-(32*i)), speed)));
                    //newpos = newpos + randint(100, 250);
                } else if dir == 0 && type_actor == 0{
                    arena.spawn(Box::new(Trunk::new(pt(newpos, 210-(40*i)), -speed)));
                    newpos = newpos + randint(100, 250);
                } else if dir == 0 && type_actor == 1{
                    //arena.spawn(Box::new(Crocodile::new(pt(newpos, 188-(32*i)), -speed)));
                    //newpos = newpos + randint(150, 250);
                } else if dir == 0 && type_actor == 2{
                    arena.spawn(Box::new(Turtle::new(pt(newpos, 210-(40*i)), -speed)));
                    newpos = newpos + randint(100, 250);
                }
            }
        }

        arena.spawn(Box::new(Frog::new(pt(arena.size().x/2, arena.size().y - 32))));

        BounceGame{arena: arena, playtime: 120}
    }
    pub fn game_over(&self) -> bool { self.remaining_lives() <= 0 || self.remaining_time() == 0}
    pub fn game_won(&self) -> bool { self.check_finishline() == true }
    pub fn check_finishline (&self) -> bool {
        let mut finishline = false;
        let actors = self.actors();
        for a in actors
        {
            if let Some(hero) = a.as_any().downcast_ref::<Frog>() {
                finishline = hero.check_finishline;
                return finishline;
            }
        }
        finishline
    }
    pub fn remaining_time(&self) -> i32 {
        self.playtime - self.arena.count() / 30
    }
    pub fn remaining_lives(&self) -> i32 {
        let mut lives = 0;
        let actors = self.actors();
        for a in actors
        {
            if let Some(hero) = a.as_any().downcast_ref::<Frog>() {
                lives = hero.lives();
                return lives;
            }
        }
        lives
    }
    pub fn tick(&mut self, keys: String) { self.arena.tick(keys); }
    pub fn size(&self) -> Pt { self.arena.size() }
    pub fn actors(&self) -> &Vec<Box<dyn Actor>> { self.arena.actors() }
}