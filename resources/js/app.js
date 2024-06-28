import './bootstrap';

import mermaid from "https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs";
mermaid.initialize({ startOnLoad: true });


/**
 * Función para construir y renderizar el diagrama de Mermaid
 * @param {Array} data - Datos del menú en formato plano
 * @param {string} elementId - ID del elemento donde se renderizará el diagrama
 */
window.renderMermaidDiagram = function (data, elementId) {
    function buildMermaidDiagram(data) {
        let diagramText = "graph LR\n";

        // data.forEach((item) => {
        //     if (item.parent) {
        //         diagramText += `${item.parent} --> ${item.key}[${item.name}]\n`;
        //     } else {
        //         diagramText += `${item.key}[${item.name}]\n`;
        //     }
        // });

        data.forEach((item) => {
            // Escapar caracteres especiales si es necesario
            const nodeName = item.name.replace(/["']/g, "\\$&"); // Escapa comillas simples o dobles
            if (item.parent) {
                diagramText += `${item.parent} --> ${item.key}["${nodeName}"]\n`;
            } else {
                diagramText += `${item.key}["${nodeName}"]\n`;
            }
        });

        return diagramText;
    }



    const diagramText = buildMermaidDiagram(data);
    console.log(diagramText);
    document.getElementById(elementId).innerHTML = diagramText;
    mermaid.init(undefined, document.getElementById(elementId));
};

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


