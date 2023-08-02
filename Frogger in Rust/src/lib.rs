use wasm_bindgen::prelude::*;
use std::cell::RefCell;

pub mod actor;
pub mod bounce;
pub mod g2d;
pub mod pt2d;
pub mod rand;

pub struct BounceGui {
    game: bounce::BounceGame
}
impl BounceGui {
    pub fn new() -> BounceGui {
        let game = bounce::BounceGame::new(pt2d::pt(640, 460), 4, 6);
        BounceGui{game}
    }
    pub fn setup(&self) {
        g2d::init_canvas(self.game.size());
        g2d::main_loop(30);
    }
    pub fn tick(&mut self) {
        g2d::clear_canvas();
        g2d::set_color(0, 64, 0); // Verde scuro
        g2d::fill_rect(pt2d::pt(0, 0), pt2d::pt(640, 90));
    
        g2d::set_color(0, 0, 255); // Blu
        g2d::fill_rect(pt2d::pt(0, 30), pt2d::pt(640, 220));

        g2d::set_color(0, 255, 0); // Verde chiaro
        g2d::fill_rect(pt2d::pt(0, 240), pt2d::pt(640, 30));
    
        g2d::set_color(128, 128, 128); // Grigio
        g2d::fill_rect(pt2d::pt(0, 270), pt2d::pt(640, 210));

        g2d::set_color(0, 255, 0); // Verde chiaro
        g2d::fill_rect(pt2d::pt(0, 430), pt2d::pt(640, 30));
        for b in self.game.actors() {
            if let Some(img) = b.sprite() {
                g2d::draw_image_clip("frogger.png".to_string(), b.pos(), img, b.size());
            } else {
                //g2d::fill_rect(b.pos(), b.size());
            }
        }
        g2d::set_color(255, 0, 0);
        let txt = format!("Lives: {} Time: {}",
            self.game.remaining_lives(), self.game.remaining_time());
        g2d::draw_text(txt, pt2d::pt(0, 0), 20);

        if self.game.game_over() {
            g2d::clear_canvas();
            g2d::init_canvas(pt2d::pt(600,450));
            g2d::draw_image_clip("gameover.png".to_string(), pt2d::pt(0, 0), pt2d::pt(0, 16), pt2d::pt(640, 480));
            //g2d::alert("Game over".to_string());
            //g2d::close_canvas();
        } else if self.game.game_won() {
            g2d::clear_canvas();
            g2d::init_canvas(pt2d::pt(600,450));
            g2d::draw_image_clip("win.png".to_string(), pt2d::pt(0, 0), pt2d::pt(0, 16), pt2d::pt(640, 480));
            //g2d::alert("Game won".to_string());
            //g2d::close_canvas();
        } else {
            self.game.tick(g2d::current_keys());  // Game logic
        }
    }
}

thread_local! {
    static GUI: RefCell<BounceGui> = RefCell::new(BounceGui::new());
}

#[wasm_bindgen]
pub fn tick() {
    GUI.with(|g| {
        g.borrow_mut().tick();
    });
}

#[wasm_bindgen]
pub fn setup() {
    GUI.with(|g| {
        g.borrow_mut().setup();
    });
}
