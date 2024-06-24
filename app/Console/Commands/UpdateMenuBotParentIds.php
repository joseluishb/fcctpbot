<?php

namespace App\Console\Commands;

use App\Models\SapM\TMenuBot;
use Illuminate\Console\Command;

class UpdateMenuBotParentIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menubot:update-parents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for update-menu-bot-parent-ids';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->updateLevel(1);
        $this->info('Parent IDs updated successfully.');
    }

    private function updateLevel($level)
    {
        $menus = TMenuBot::where('nivel', $level)->get();

        foreach ($menus as $menu) {
            $children = TMenuBot::where('id_proceso', 'like', $menu->id_proceso . '.%')
                ->where('nivel', $level + 1)
                ->get();

            foreach ($children as $child) {
                $child->parent_id = $menu->id_menu;
                $child->save();
            }
        }

        if (!$menus->isEmpty()) {
            $this->updateLevel($level + 1);
        }
    }
}
