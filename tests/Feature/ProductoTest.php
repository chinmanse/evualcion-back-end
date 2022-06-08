<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Producto;

class ProductoTest extends TestCase
{
    
    /**
     * Test para probar el creado del producto
     * @return void
     */
    public function test_create_producto(){
        $this->withoutExceptionHandling();
        $response = $this->post('/api/productos', [
            "nombre" => "Producto de prueba",
            "descripcion" => "Descripcion del producto de prueba",
            "ruta" => "ruta/producto/prueba",
            "coste" => "10.00",
            "stock" => "10",
            "estado" => "1"
        ]);

        $response->assertStatus(201);

        $producto = Producto::latest('id')->first();

        $this->assertEquals($producto->nombre ,"Producto de prueba");
        $this->assertEquals($producto->descripcion ,"Descripcion del producto de prueba");
        $this->assertEquals($producto->ruta ,"ruta/producto/prueba");
        $this->assertEquals($producto->coste ,"10.00");
        $this->assertEquals($producto->stock ,"10");
        $this->assertEquals($producto->estado ,"1");

    }
    /**
     * Test para probar la edicion de un producto
     */

    public function test_update_product(){
        $this->withoutExceptionHandling();
        $productId = 1;
        $response = $this->put('/api/productos/' . $productId, [
            "nombre" => "Producto de Editado",
            "descripcion" => "Descripcion del producto de prueba",
            "ruta" => "ruta/producto/prueba",
            "coste" => "10.00",
            "stock" => "10",
            "estado" => "1"
        ]);

        $response->assertStatus(201);

        $producto = Producto::find($productId);

        $this->assertEquals($producto->nombre ,"Producto de Editado");
        $this->assertEquals($producto->descripcion ,"Descripcion del producto de prueba");
        $this->assertEquals($producto->ruta ,"ruta/producto/prueba");
        $this->assertEquals($producto->coste ,"10.00");
        $this->assertEquals($producto->stock ,"10");
        $this->assertEquals($producto->estado ,"1");
    }

    /**
     * Test para probar la eliminación de un producto
     */

    public function test_delete_product(){
        $productId = 1;
        $response = $this->delete("/api/productos/" . $productId);

        $response->assertStatus(201);

        $producto = Producto::find($productId);

        $this->assertEquals($producto->estado ,"2");
    }

}
