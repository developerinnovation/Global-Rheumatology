<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/basic/templates/views/home/views-view-fields--home--block-1.html.twig */
class __TwigTemplate_079c33ce758b70c218d7565a3cf9a3d68bf91f10181b6805f0a7cc80b1ef976d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 4, "if" => 4];
        $filters = ["escape" => 2];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"item-news destacada home\">
    <figure>";
        // line 2
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "field_image", []), "content", [])), "html", null, true);
        echo "</figure>
    <div class=\"text\">
        <div ";
        // line 4
        $context["nid"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["row"] ?? null), "_entity", []), "nid", []), "value", []);
        echo " class=\"save ";
        if (twig_in_filter(($context["nid"] ?? null), $this->getAttribute($this->getAttribute(($context["user"] ?? null), "node_saved", []), "split", [], "array"))) {
            echo "saved";
        } else {
            echo "no";
        }
        echo "\" data-id=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["nid"] ?? null)), "html", null, true);
        echo "\" data-session=\"";
        if (($this->getAttribute(($context["user"] ?? null), "id", []) != 0)) {
            echo "authentificate";
        } else {
            echo "anonime";
        }
        echo "\">
            <a href=\"#\" class=\"node_saved\">Guardar</a>
        </div>
        <span class=\"category\">";
        // line 7
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "field_categoria", []), "content", [])), "html", null, true);
        echo "</span>
        <h2 class=\"title\">";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "title", []), "content", [])), "html", null, true);
        echo "</h2>
        <p class=\"sumary\">";
        // line 9
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "body", []), "content", [])), "html", null, true);
        echo "</p>
        <div class=\"explorer\">";
        // line 10
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "nothing_1", []), "content", [])), "html", null, true);
        echo "</div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/basic/templates/views/home/views-view-fields--home--block-1.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 10,  91 => 9,  87 => 8,  83 => 7,  63 => 4,  58 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/basic/templates/views/home/views-view-fields--home--block-1.html.twig", "/Applications/MAMP/htdocs/Global-Rheumatology/themes/custom/basic/templates/views/home/views-view-fields--home--block-1.html.twig");
    }
}
