<?php 

namespace Drupal\manuscrito\Plugin\Block;

use Drupal\Component\Transliteration\TransliterationInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\manuscrito\Plugin\Config\Block\ActionsBlockClass;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a 'ActionsBlock' block.
 *
 * @Block(
 *  id = "global_rehumatology_actions",
 *  admin_label = @Translation("Acciones para proceso editorial"),
 * )
 */
class ActionsBlock extends BlockBase implements ContainerFactoryPluginInterface{
    /**
     * @var \Drupal\manuscrito\Plugin\Config\Block\ActionsBlockClass
     */
    protected $configurationInstance;

    /**
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @param \Drupal\manuscrito\Plugin\Config\Block\ActionsBlockClass $configurationInstance
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, ActionsBlockClass $configurationInstance) {
        // Store our dependency.
        $this->configurationInstance = $configurationInstance;

        // Call parent construct method.
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        // Set init config.
        $this->configurationInstance->setConfig($this, $this->configuration);
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @return static
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('manuscrito.actions')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        if (method_exists($this->configurationInstance, 'defaultConfiguration')) {
            return $this->configurationInstance->defaultConfiguration();
        }
        return parent::defaultConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function blockAccess(AccountInterface $account) {
        if (method_exists($this->configurationInstance, 'blockAccess')) {
            return $this->configurationInstance->blockAccess($account);
        }
        return parent::blockAccess($account);
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        if (method_exists($this->configurationInstance, 'blockForm')) {
            return $this->configurationInstance->blockForm($form, $form_state, $this->configuration);
        }
        return parent::blockForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        if (method_exists($this->configurationInstance, 'blockSubmit')) {
            $this->configurationInstance->blockSubmit($form, $form_state, $this->configuration);
        }
        // TODO: Change the autogenerated stub.
        parent::blockSubmit($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function blockValidate($form, FormStateInterface $form_state) {
        if (method_exists($this->configurationInstance, 'blockValidate')) {
            return $this->configurationInstance->blockValidate($form, $form_state);
        }
        // TODO: Change the autogenerated stub.
        parent::blockValidate($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        if (method_exists($this->configurationInstance, 'build')) {
            return $this->configurationInstance->build($this, $this->configuration);
        }
        return parent::build();
    }

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
        if (method_exists($this->configurationInstance, 'buildConfigurationForm')) {
            return $this->configurationInstance->buildConfigurationForm($form, $form_state);
        }
        // TODO: Change the autogenerated stub.
        return parent::buildConfigurationForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function getMachineNameSuggestion() {
        if (method_exists($this->configurationInstance, 'getMachineNameSuggestion')) {
            return $this->configurationInstance->getMachineNameSuggestion();
        }
        // TODO: Change the autogenerated stub.
        return parent::getMachineNameSuggestion();
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge() {
        if (method_exists($this->configurationInstance, 'getCacheMaxAge')) {
            return $this->configurationInstance->getCacheMaxAge();
        }
        return parent::getCacheMaxAge();
    }

    /**
     * {@inheritdoc}
     */
    public function setTransliteration(TransliterationInterface $transliteration) {
        if (method_exists($this->configurationInstance, 'setTransliteration')) {
            return $this->configurationInstance->setTransliteration($transliteration);
        }
        // TODO: Change the autogenerated stub.
        parent::setTransliteration($transliteration);
    }

    /**
     * {@inheritdoc}
     */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
        if (method_exists($this->configurationInstance, 'submitConfigurationForm')) {
            return $this->configurationInstance->submitConfigurationForm($form, $form_state);
        }
        // TODO: Change the autogenerated stub.
        parent::submitConfigurationForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
        if (method_exists($this->configurationInstance, 'validateConfigurationForm')) {
            return $this->configurationInstance->validateConfigurationForm($form, $form_state);
        }
        // TODO: Change the autogenerated stub.
        parent::validateConfigurationForm($form, $form_state);
    }

}