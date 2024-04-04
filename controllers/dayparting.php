<?php

/*
    Copyright 2012-2024 OpenBroadcaster, Inc.

    This file is part of OpenBroadcaster Server.

    OpenBroadcaster Server is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    OpenBroadcaster Server is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with OpenBroadcaster Server.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Manages dynamic selection media restrictions based on media search criteria, date, and time.
 * Requires 'manage media settings' permission.
 *
 * @package Controller
 */
class Dayparting extends OBFController
{
    public function __construct()
    {
        parent::__construct();
        $this->user->require_permission('manage_media_settings');
    }

    /**
     * Get all restrictions.
     *
     * @return restrictions
     *
     * @route GET /v2/dayparting/search
     */
    public function search()
    {
        return $this->models->dayparting('search');
    }

    /**
     * Get restriction by id.
     *
     * @param id
     *
     * @return restrction
     *
     * @route GET /v2/dayparting/(:id:)
     */
    public function get()
    {
        return $this->models->dayparting('get', ['id' => $this->data('id')]);
    }

    /**
     * Save restriction.
     *
     * @param id
     * @param start_month
     * @param start_day
     * @param start_time
     * @param end_month
     * @param end_day
     * @param end_time
     * @param filters
     *
     * @return id
     *
     * @route PUT /v2/dayparting/(:id:)
     */
    public function save()
    {
        $data = [];
        $data['id'] = $this->data('id');
        $data['description'] = $this->data('description');
        $data['type'] = $this->data('type');
        $data['start'] = $this->data('start');
        $data['end'] = $this->data('end');
        $data['dow'] = $this->data('dow');
        $data['filters'] = $this->data('filters');

        return $this->models->dayparting('save', $data);
    }

    /**
     * Delete restriction.
     *
     * @param id
     *
     * @route DELETE /v2/dayparting/(:id:)
     */
    public function delete()
    {
        return $this->models->dayparting('delete', ['id' => $this->data('id')]);
    }
}
