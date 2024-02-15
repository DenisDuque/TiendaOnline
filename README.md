# Composer

Composer is required to enable de PDF creation.

## Libraries

To use the PDF library [mpdf](https://packagist.org/packages/mpdf/mpdf), open a terminal in the project root and execute this command.

```bash
composer require mpdf/mpdf
```

# ThreeJS Visualizer

The 3D visualizer has to be downloaded from his own repository, located at [ThreeJSVisualizer](https://github.com/DenisDuque/ThreeJSVisualizer).

Remember you need to start the project aside this one, it will start on another localhost port, if you need to edit the port, change the port in the file **[productPage.js](https://github.com/DenisDuque/TiendaOnline/views/js/archivo.js)**

```js
visualizerBtn.addEventListener('click', function() {
        const queryParams = new URLSearchParams(window.location.search);

        const code = queryParams.get('code');
        //Change the port according your preferences
        const port = '5173';

        const ThreeJSVisualizer = 'http://localhost:'+ port +'?model=' + code;

        window.open(ThreeJSVisualizer, '_blank');
    });
```
