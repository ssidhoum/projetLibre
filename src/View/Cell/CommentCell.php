namespace App\View\Cell;

use Cake\View\Cell;

class CommentCell extends Cell
{

    public function display()
    {
    	$this->loadModel('Comments');
    }

}