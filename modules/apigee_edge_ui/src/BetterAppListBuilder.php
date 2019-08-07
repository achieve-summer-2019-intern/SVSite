<?php

/**
 * @file
 * Apigee Edge UI module for Drupal.
 *
 * Copyright (C) 2019 PRONOVIX GROUP BVBA.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
 * USA.
 */

namespace Drupal\apigee_edge_ui;

use Drupal\apigee_edge\Entity\AppInterface;
use Drupal\apigee_edge\Entity\ListBuilder\DeveloperAppListBuilderForDeveloper;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Template\Attribute;

/**
 * Advanced list builder for developer apps.
 */
class BetterAppListBuilder extends DeveloperAppListBuilderForDeveloper {

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();

    // Use custom template instead of table.
    unset($build['table']['#type']);
    $build['table']['#theme'] = 'developer_app_list_for_developer';

    // Add extra class for theming.
    $build['table']['#attributes']['class'][] = 'developer-app-list';

    // Build the app rows from scratch.
    $build['table']['#apps'] = [];
    foreach ($this->load() as $entity) {
      $app_row = [
        'attributes' => new Attribute([
          'id' => $this->getCssIdForInfoRow($entity),
          'class' => 'row--info',
        ]),
        'name' => [
          '#type' => 'link',
          '#title' => $entity->label(),
          '#url' => $entity->toUrl('canonical-by-developer'),
        ],
        'status' => $this->renderAppStatus($entity),
        'operations' => $this->buildOperations($entity),
        'warning_attributes' => new Attribute([
          'id' => $this->getCssIdForWarningRow($entity),
          'class' => 'row--warning',
        ]),
      ];

      if ($warning_message = $this->getWarningText($entity)) {
        $app_row['warning_message'] = $warning_message;
      }

      $build['table']['#apps'] += [$this->getCssIdForInfoRow($entity) => $app_row];
    }

    $build['#attached']['library'][] = 'apigee_edge_ui/apigee_edge_ui.app_listing';

    return $build;
  }

  /**
   * Returns the warning text for an app.
   *
   * @param AppInterface $app
   *   The app entity.
   * @return TranslatableMarkup|null
   *   The warning text.
   */
  protected function getWarningText(AppInterface $app): ?TranslatableMarkup {
    $warnings = $this->checkAppCredentialWarnings($app);

    // Display warning sign next to the status if the app's status is
    // approved, but:
    // - any credentials of the app is in revoked status
    // - any products of any credentials of the app is in revoked or
    //   pending status.
    if ($app->getStatus() === AppInterface::STATUS_APPROVED && ($warnings['revokedCred'] || $warnings['revokedOrPendingCredProduct'])) {
      if ($warnings['revokedCred']) {
        return $warnings['revokedCred'];
      }
      elseif ($warnings['revokedOrPendingCredProduct']) {
        return $warnings['revokedOrPendingCredProduct'];
      }
    }

    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultOperations(EntityInterface $entity): array {
    $operations = parent::getDefaultOperations($entity);
    if ($entity->access('view')) {
      $operations['view'] = [
        'title' => $this->t('View'),
        'weight' => -150,
        'url' => $entity->toUrl('canonical-by-developer'),
      ];
    }

    return $operations;
  }

}
