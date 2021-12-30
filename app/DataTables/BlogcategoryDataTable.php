<?php

namespace App\DataTables;

use App\Models\Blogcategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogcategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('action', function ($data){
                $result = "";
                $result .= '<button class="btn btn-success admin_category_edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></button>               
                <button class="btn btn-danger delete_category"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
                return $result;        
        })
      
        ->rawColumns(['action'])
        ->addIndexColumn();
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blogcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Blogcategory $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('blogcategory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('categories_name')->title('Categorie'),

                  Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Blogcategory_' . date('YmdHis');
    }
}
