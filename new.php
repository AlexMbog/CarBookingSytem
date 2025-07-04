<!--
  Copyright 2023 Google LLC

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Commutes and Destinations Map</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../S/map.js">
  </head>
  <style>
  html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.commutes {
  align-content: stretch;
  color: #202124;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  font-family: Arial, sans-serif;
  height: 100%;
  min-height: 256px;
  min-width: 360px;
  overflow: auto;
  width: 100%;
}

.commutes-info {
  flex: 0 0 110px;
  max-width: 100%;
  overflow: hidden;
}

.commutes-initial-state {
  border-radius: 8px;
  border: 1px solid #dadce0;
  display: flex;
  height: 98px;
  margin-top: 8px;
  padding: 0 16px;
}

.commutes-initial-state svg {
  align-self: center;
}

.commutes-initial-state .description {
  align-self: center;
  flex-grow: 1;
  padding: 0 16px;
}

.commutes-initial-state .description .heading {
  font: 22px/28px Arial, sans-serif;
  margin: 0;
}

.commutes-initial-state .description p {
  color: #5f6368;
  font: 13px/20px Arial, sans-serif;
  margin: 0;
}

.commutes-initial-state .add-button {
  align-self: center;
  background-color: #4285f4;
  border-color: #4285f4;
  border-radius: 4px;
  border-style: solid;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  fill: #fff;
  padding: 8px 16px 8px 8px;
  white-space: nowrap;
}

.commutes-initial-state .add-button .label {
  font: normal 600 15px/24px Arial, sans-serif;
  padding-left: 8px;
}

@media (max-width: 535px) {
  .commutes-initial-state svg {
    display: none;
  }

  .commutes-initial-state .description {
    padding-left: 0;
  }

  .commutes-initial-state .description .heading {
    font-weight: bold;
    font-size: 15px;
    line-height: 24px;
  }
}

.commutes-destinations {
  display: none;
  position: relative;
  width: 100%;
}

.commutes-destinations:hover .visible {
  display: block;
}

.commutes-destinations .destinations-container {
  display: flex;
  overflow-x: auto;
  padding: 8px 8px 4px 8px;
  white-space: nowrap;
  width: 100%;
}

.commutes-destinations .destinations-container::-webkit-scrollbar {
  display: none;
}

.commutes-destinations .destinations-container::-webkit-scrollbar-thumb {
  background-color: #dadce0;
  width: 4px;
}

.commutes-destinations .destination-list {
  display: flex;
  flex-grow: 1;
}

.commutes-destinations .right-control,
.commutes-destinations .left-control {
  background-color: #fff;
  border-radius: 40px;
  border-style: none;
  bottom: 35px;
  box-shadow: 0 2px 3px 0 rgb(60 64 67 / 30%), 0 6px 10px 4px rgb(60 64 67 / 15%);
  cursor: pointer;
  fill: #616161;
  height: 40px;
  padding: 8px;
  position: absolute;
  width: 40px;
  z-index: 100;
}

.commutes-destinations .right-control:hover,
.commutes-destinations .left-control:hover {
  background-color: #f1f3f4;
}

.commutes-destinations .left-control {
  left: 16px;
}

.commutes-destinations .right-control {
  right: 16px;
}

.commutes-destinations .add-button {
  align-items: center;
  background-color: #e8f0fe;
  border-radius: 8px;
  border-color: #e8f0fe;
  border-style: solid;
  color: #1967d2;
  cursor: pointer;
  display: flex;
  fill: #1967d2;
  flex-direction: column;
  flex-grow: 1;
  font-weight: bold;
  gap: 4px;
  justify-content: center;
  min-width: 156px;
  padding: 20px 16px;
}

.commutes-destinations .add-button:hover {
  background-color: #d2e3fc;
  border-color: #d2e3fc;
  color: #185abc;
  fill: #185abc;
}

.commutes-destinations .destination-container {
  cursor: pointer;
  display: flex;
  flex: 1 1 0;
  position: relative;
}

.commutes-destinations .destination {
  border-radius: 4px;
  box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
  color: #5f6368;
  fill: #5f6368;
  height: 72px;
  justify-content: space-between;
  margin-right: 8px;
  min-width: 256px;
  overflow: hidden;
  padding: 12px;
  position: relative;
  width: 100%;
}

.commutes-destinations .active:after {
  background-color: #4285f4;
  content: '';
  display: block;
  height: 4px;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

.commutes-destinations .active + .destination-controls .directions-button {
  fill: #4285f4;
}

.commutes-destinations .active + .destination-controls .edit-button {
  opacity: 1;
}

.commutes-destinations .active .metadata .location-marker {
  background-color: #fce8e6;
  color: #d93025;
}

.commutes-destinations .destination-container:hover,
.commutes-destinations .destination-container:focus-within
{
  background-color: #f8f9fa;
}

.commutes-destinations .destination-container:hover .edit-button,
.commutes-destinations .destination-container:focus-within .edit-button
{
  opacity: 1;
}

.commutes-destinations .destination .destination-content {
  font-size: 12px;
  line-height: 20px;
  overflow: hidden;
}

.commutes-destinations .destination .metadata {
  align-items: center;
  display: flex;
  margin-bottom: 4px;
  gap: 4px;
}

.commutes-destinations .destination-container svg {
  height: 18px;
  width: 18px;
}

.commutes-destinations .destination .location-marker {
  background-color: #f1f3f4;
  border-radius: 8px;
  color: #616161;
  display: inline-block;
  font-size: 14px;
  font-weight: bold;
  line-height: 16px;
  text-align: center;
  width: 16px;
}

.commutes-destinations .destination .address {
  margin-bottom: 4px;
  max-width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.commutes-destinations .destination .address abbr {
  text-decoration: none;
}

.commutes-destinations .destination .destination-eta {
  color: #202124;
  font-weight: bold;
  font-size: 22px;
  line-height: 28px;
}

.commutes-destinations .destination-container .destination-controls {
  align-items: flex-end;
  display: flex;
  flex-direction: column;
  min-width: 70px;
  position: absolute;
  right: 20px;
  text-align: right;
  top: 12px;
  white-space: nowrap;
}

.commutes-destinations .destination-container .directions-button {
  align-items: center;
  background-color: #fff;
  border-radius: 32px;
  border: 1px solid #dadce0;
  cursor: pointer;
  display: flex;
  fill: #5f6368;
  height: 32px;
  justify-content: center;
  margin: 0;
  width: 34px;
}

.commutes-destinations .destination-container .directions-button:hover {
  background-color: #e8f0fe;
  fill: #4285f4;
}

.commutes-destinations .destination-container .edit-button {
  background-color: #fff;
  border-radius: 20px;
  border: 1px solid #dadce0;
  opacity: 0;
  font-size: 14px;
  font-weight: bold;
  line-height: 22px;
  margin: 8px 0 0 0;
  padding: 3px 12px 3px 5px;
  fill: #616161;
  color: #616161;
  cursor: pointer;
}

.commutes-destinations .destination-container .edit-button svg {
  display: inline-block;
  font-size: 20px;
  line-height: 20px;
  width: 20px;
  vertical-align: middle;
}

.commutes-destinations .destination-container .edit-button:hover {
  background-color: #f1f3f4;
}

.commutes-map {
  flex: 1;
  overflow: hidden;
  position: relative;
  width: 100%;
}

.commutes-map .map-view {
  background-color: rgb(229, 227, 223);
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

.commutes-modal-container {
  align-items: center;
  background-color: rgba(0, 0, 0, 0.4);
  display: none;
  height: 100%;
  justify-content: center;
  left: 0;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

.commutes-modal {
  background: #fff;
  border-radius: 4px;
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px rgba(0, 0, 0, 0.14), 0 1px 10px rgba(0, 0, 0, 0.12);
  height: 256px;
  position: absolute;
  width: 360px;
}

.commutes-modal .content {
  padding: 24px 24px 8px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.commutes-modal .heading {
  font: 24px/32px Arial, sans-serif;
  margin: 0;
}

.commutes-modal input {
  font: 16px/24px Arial, sans-serif;
  padding: 10px;
  box-sizing: border-box;
  width: 100%;
}

.commutes-modal .error {
  background-color: #fce4e4;
  border: 1px solid #c03;
}

.commutes-modal .error-message {
  color: #c03;
  display: inline-block;
  font: 12px/14px Arial, sans-serif;
  margin: 0 0 5px;
}

.commutes-modal .travel-modes {
  display: flex;
  flex-direction: row;
  height: 40px;
  margin-bottom: 12px;
  padding: 0;
  width: 100%;
}

.commutes-modal .travel-modes [type=radio] {
  height: 0;
  opacity: 0;
  position: absolute;
  width: 0;
}

.commutes-modal .travel-modes label {
  align-items: center;
  border: solid #dadce0;
  border-width: 1px 0.031em;
  cursor: pointer;
  display: inline-flex;
  fill: #5f6368;
  flex: 1;
  justify-content: center;
  padding: 6px;
  position: relative;
  transition: background 0.5s, fill 0.5s;
}

.commutes-modal .travel-modes label:hover {
  background-color: #f1f3f4;
}

.commutes-modal .travel-modes svg {
  height: 24px;
  width: 24px;
}

.commutes-modal .travel-modes .left-label {
  border-left-width: 1px;
  border-radius: 4px 0 0 4px;
}

.commutes-modal .travel-modes .right-label {
  border-radius: 0 4px 4px 0;
  border-right-width: 1px;
}

.commutes-modal .travel-modes input[type=radio]:checked+label {
  background: #e8f0fe;
  fill: #1967d2;
}

.commutes-modal .travel-modes input[type=radio]:focus-visible+label {
  outline: 2px solid Highlight;
  outline: 2px solid -webkit-focus-ring-color;
  outline-offset: -2px;
}

.commutes-modal .modal-action-bar {
  display: flex;
  justify-content: flex-end;
}

.commutes-modal .modal-action-bar button {
  background: #ffff;
  border: none;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
  line-height: 32px;
}

.commutes-modal .modal-action-bar .delete-destination-button {
  color: #c5221f;
  left: 18px;
  position: absolute;
}

.commutes-modal .modal-action-bar .cancel-button {
  color: #0000008a;
}

.commutes-modal .modal-action-bar .add-destination-button,
.commutes-modal .modal-action-bar .edit-destination-button {
  color: #1a73e8;
}

.hide {
  display: none;
}
</style>
  <body>
    <!-- Defined commutes SVGs -->
    <svg class="hide">
      <defs>
        <symbol id="commutes-initial-icon">
          <path d="M41 20H18.6c-9.5 0-10.8 13.5 0 13.5h14.5C41 33.5 41 45 33 45H17.7" stroke="#D2E3FC" stroke-width="5"></path>
          <path d="M41 22c.2 0 .4 0 .6-.2l.4-.5c.3-1 .7-1.7 1.1-2.5l2-3c.8-1 1.5-2 2-3 .6-1 .9-2.3.9-3.8 0-2-.7-3.6-2-5-1.4-1.3-3-2-5-2s-3.6.7-5 2c-1.3 1.4-2 3-2 5 0 1.4.3 2.6.8 3.6s1.2 2 2 3.2c.9 1 1.6 2 2 2.8.5.9 1 1.7 1.2 2.7l.4.5.6.2Zm0-10.5c-.7 0-1.3-.2-1.8-.7-.5-.5-.7-1.1-.7-1.8s.2-1.3.7-1.8c.5-.5 1.1-.7 1.8-.7s1.3.2 1.8.7c.5.5.7 1.1.7 1.8s-.2 1.3-.7 1.8c-.5.5-1.1.7-1.8.7Z" fill="#185ABC"></path>
          <path d="m12 32-8 6v12h5v-7h6v7h5V38l-8-6Z" fill="#4285F4"></path>
        </symbol>
      </defs>
      <use href="#commutes-initial-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-add-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </symbol>
      </defs>
      <use href="#commutes-add-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-driving-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-5h14v5z"/>
          <circle cx="7.5" cy="14.5" r="1.5"/>
          <circle cx="16.5" cy="14.5" r="1.5"/>
        </symbol>
      </defs>
      <use href="#commutes-driving-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-transit-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M12 2c-4 0-8 .5-8 4v9.5C4 17.43 5.57 19 7.5 19L6 20.5v.5h12v-.5L16.5 19c1.93 0 3.5-1.57 3.5-3.5V6c0-3.5-3.58-4-8-4zm5.66 3H6.43c.61-.52 2.06-1 5.57-1 3.71 0 5.12.46 5.66 1zM11 7v3H6V7h5zm2 0h5v3h-5V7zm3.5 10h-9c-.83 0-1.5-.67-1.5-1.5V12h12v3.5c0 .83-.67 1.5-1.5 1.5z"/>
          <circle cx="8.5" cy="14.5" r="1.5"/>
          <circle cx="15.5" cy="14.5" r="1.5"/>
        </symbol>
      </defs>
      <use href="#commutes-transit-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-bicycling-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M15.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM5 12c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8.5c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5zm5.8-10l2.4-2.4.8.8c1.3 1.3 3 2.1 5.1 2.1V9c-1.5 0-2.7-.6-3.6-1.5l-1.9-1.9c-.5-.4-1-.6-1.6-.6s-1.1.2-1.4.6L7.8 8.4c-.4.4-.6.9-.6 1.4 0 .6.2 1.1.6 1.4L11 14v5h2v-6.2l-2.2-2.3zM19 12c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 8.5c-1.9 0-3.5-1.6-3.5-3.5s1.6-3.5 3.5-3.5 3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5z"/>
        </symbol>
      </defs>
      <use href="#commutes-bicycling-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-walking-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.56-.89-1.68-1.25-2.65-.84L6 8.3V13h2V9.6l1.8-.7"/>
        </symbol>
      </defs>
      <use href="#commutes-walking-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-chevron-left-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z"/>
        </symbol>
      </defs>
      <use href="#commutes-chevron-left-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-chevron-right-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path xmlns="http://www.w3.org/2000/svg" d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/>
        </symbol>
      </defs>
      <use href="#commutes-chevron-right-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-arrow-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z"/>
        </symbol>
      </defs>
      <use href="#commutes-arrow-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-directions-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M22.43 10.59l-9.01-9.01c-.75-.75-2.07-.76-2.83 0l-9 9c-.78.78-.78 2.04 0 2.82l9 9c.39.39.9.58 1.41.58.51 0 1.02-.19 1.41-.58l8.99-8.99c.79-.76.8-2.02.03-2.82zm-10.42 10.4l-9-9 9-9 9 9-9 9zM8 11v4h2v-3h4v2.5l3.5-3.5L14 7.5V10H9c-.55 0-1 .45-1 1z"/>
        </symbol>
      </defs>
      <use href="#commute-directions-icon"/>
    </svg>
    <svg class="hide">
      <defs>
        <symbol id="commutes-edit-icon">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/>
        </symbol>
      </defs>
      <use href="#commute-edit-icon"/>
    </svg>
    <!-- End commutes SVGs -->

    <main class="commutes">
      <div class="commutes-map" aria-label="Map">
        <div class="map-view"></div>
      </div>

      <div class="commutes-info">
        <div class="commutes-initial-state">
          <svg aria-label="Directions Icon" width="53" height="53" fill="none" xmlns="http://www.w3.org/2000/svg">
            <use href="#commutes-initial-icon"/>
          </svg>
          <div class="description">
            <h1 class="heading">Estimate commute time</h1>
            <p>See travel time and directions for places nearby</p>
          </div>
          <button class="add-button" autofocus>
            <svg aria-label="Add Icon" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg">
              <use href="#commutes-add-icon"/>
            </svg>
            <span class="label">Add destination</span>
          </button>
        </div>

        <div class="commutes-destinations">
          <div class="destinations-container">
            <div class="destination-list"></div>
            <button class="add-button">
              <svg aria-label="Add Icon" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg">
                <use href="#commutes-add-icon"/>
              </svg>
              <div class="label">Add destination</div>
            </button>
          </div>
          <button class="left-control hide" data-direction="-1" aria-label="Scroll left">
            <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" data-direction="-1">
              <use href="#commutes-chevron-left-icon" data-direction="-1"/>
            </svg>
          </button>
          <button class="right-control hide" data-direction="1" aria-label="Scroll right">
            <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" data-direction="1">
              <use href="#commutes-chevron-right-icon" data-direction="1"/>
            </svg>
          </button>
        </div>
      </div>
    </main>

    <div class="commutes-modal-container">
      <div class="commutes-modal" role="dialog" aria-modal="true" aria-labelledby="add-edit-heading">
        <div class="content">
          <h2 id="add-edit-heading" class="heading">Add destination</h2>
          <form id="destination-form">
            <input type="text" id="destination-address-input" name="destination-address" placeholder="Enter a place or address" autocomplete="off" required>
            <div class="error-message" role="alert"></div>
            <div class="travel-modes">
              <input type="radio" name="travel-mode" id="driving-mode" value="DRIVING" aria-label="Driving travel mode">
              <label for="driving-mode" class="left-label" title="Driving travel mode">
                <svg aria-label="Driving icon" mlns="http://www.w3.org/2000/svg">
                  <use href="#commutes-driving-icon"/>
                </svg>
              </label>
              <input type="radio" name="travel-mode" id="transit-mode" value="TRANSIT" aria-label="Public transit travel mode">
              <label for="transit-mode" title="Public transit travel mode">
                <svg aria-label="Public transit icon" xmlns="http://www.w3.org/2000/svg">
                  <use href="#commutes-transit-icon"/>
                </svg>
              </label>
              <input type="radio" name="travel-mode" id="bicycling-mode" value="BICYCLING" aria-label="Bicycling travel mode">
              <label for="bicycling-mode" title="Bicycling travel mode">
                <svg aria-label="Bicycling icon" xmlns="http://www.w3.org/2000/svg">
                  <use href="#commutes-bicycling-icon"/>
                </svg>
              </label>
              <input type="radio" name="travel-mode" id="walking-mode" value="WALKING" aria-label="Walking travel mode">
              <label for="walking-mode" class="right-label" title="Walking travel mode">
                <svg aria-label="Walking icon" xmlns="http://www.w3.org/2000/svg">
                  <use href="#commutes-walking-icon"/>
                </svg>
              </label>
            </div>
          </form>
          <div class="modal-action-bar">
            <button class="delete-destination-button hide" type="reset">
              Delete
            </button>
            <button class="cancel-button" type="reset">
              Cancel
            </button>
            <button class="add-destination-button" type="button">
              Add
            </button>
            <button class="edit-destination-button hide" type="button">
              Done
            </button>
          </div>
        </div>
      </div>
    </div>
    <script src="../SCRIPTS/map.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpstdF2iSB36LPIXVTRNIcsF-_YpTrejU&callback=initMap&libraries=places,geometry&solution_channel=GMP_QB_commutes_v2_c" async defer></script>
  </body>
</html>
