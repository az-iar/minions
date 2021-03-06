# Changelog for v1.x

This changelog references the relevant changes (bug and security fixes) done to `katsana/minions`.

## 1.10.0

Released: 2020-07-22

### Added

* Added methods to `Minions\Exceptions\RequestException` to access exception from response object:
    - `getRpcError()`
    - `getRpcErrorCode()`
    - `getRpcErrorMessage()`

## 1.9.0

Released: 2020-05-01

### Added

* Added `Minions\Client\Minion::enabled()` method.
* Added `Minions\Testing\MakesRpcRequests::sendRpc()` method.
* Added `Minions\Testing\TestResponse::assertStatus()` method.

## 1.8.0

Released: 2020-04-20

### Added

* Added `Minions\Client\Response::toArray()` method.

### Changes

* Emulate JSONRPC error when response status code is not `200`, `201`, `203`, `204` or `205`.
* Allow to `serialize()` and `unserialize()` instance of `Minions\Client\Response`.

## 1.7.0

Released: 2020-04-11

### Added

* Added `Minions\Client\Minion::queue()` method.
* Added `Minions\Testing\TestResponse::output()` method.

### Changes

* Explicitly require `clue/buzz-react`, `nyholm/psr7` and `symfony/psr-http-message-bridge` to streamline out of the box feature.
* Update minimum `laravie/stream` to `v1.3`+.
* Allow project `token` and `signature` to be set to `null` for app to app communication under private intranet.
* Add `Minions\Exceptions\RequestException::report()` method to send custom error log to Laravel logger. 

## 1.6.1

Released: 2020-04-09

### Fixes

* Make testing client configuration contain `endpoint` to avoid regression issue after moving to new `Minions\Configuration` class.

## 1.6.0

Released: 2020-03-27

### Added

* Added `Minions\Configuration` instead of using `array` for configuration.
* Added `minions.config` to Laravel service container.

### Changes

* Add `Minions\Router::routeResolver()` as alias to `Minions\Http\Router::routeResolver()`.

### Deprecated

* Deprecate `Minions\Concerns\Configuration` and will be removed in `v3.0.0`.

## 1.5.1

Released: 2020-03-26

### Fixes

* `Minions\Testing\TestResponse::assertOk()` should failed if response has error code.

## 1.5.0

Released: 2020-03-23

### Added

* Added `Minions\Testing\TestResponse`.

### Changes

* Use `Minions\Exceptions\Exception` on `Minions\Http\Evaluator`.

## 1.4.1

Released: 2020-03-22

### Added

* Add `Minions\Finder::boot()` method to handle lazy projects registration.

### Fixed

* Fixed variable on `Minions\Http\ValidatesRequests::validate()`.

## 1.4.0

Released: 2020-03-21

### Added

* Added `Minions\Http\ValidatesRequests` trait.
* Added `Minions\Testing\MakesRpcRequests` trait.

## 1.3.1

Released: 2020-03-18

### Fixes

* Fixes `Minions\Router` facade docblock.

## 1.3.0

Released: 2020-03-16

### Added

* Add `authorize(\Minions\Http\Message $message)` method to authorising the request.

## 1.2.5

Released: 2020-03-15

### Added

* Added environment variable `MINIONS_ENABLED` to allow disabling Minions on certain environment.

## 1.2.4

Released: 2020-03-15

### Changes

* Mark `Minions\MinionsServiceProvider` as deferred.

## 1.2.3

Released: 2020-03-09

### Changes

* Add `toArray()` on `Minions\Client\Message` and `Minions\Client\Notification`.
* Ability to convert `Illuminate\Contracts\Support\Arrayable` response to `array`. 

## 1.2.2

Released: 2020-02-10

### Changes

* Resolve `Orchestra\Canvas\Core\Presets\Laravel` when registering `Minions\Http\Console\MakeRpcRequest` command.

## 1.2.1

Released: 2020-02-06

### Changes

* Register `Minions\Http\Console\MakeRpcRequest` command directly to console kernel without having to bind to the Container.

### Fixes

* Remove invalid `$id` parameter when using `Minions\Minion::notification()` helper.

## 1.2.0

Released: 2020-01-25

### Added

* Add `minions:make` command to generate Request Handler.
* Add `Minions\Http\Router::routeResolver()` and automatically register `routes/rpc.php`.
* Add `Minions\Minion::message()` and `Minions\Minion::notification()` helper methods.

### Changes

* Split ReactPHP RPC Server implementation to [katsana/minions-server](https://github.com/katsana/minions-server).
* Add default request timeout to 60 seconds. 
* Rename server related classes to `Minions\Http` to be reused by `minions-server` and `minions-polyfill`.

### Breaking Changes

* Deprecate and remove `Minions\Server\Message`, please update to `Minions\Http\Message` if you used it on your Request Handler.

## 1.1.0

Released: 2019-12-26

### Changes

* Improves `Minions\Exceptions\Exception`.
* Update supported Laravel Framework to `6.x` and `7.x`.
* Implements console exit code.

### Removed

* Removed support for Laravel Framework `5.8`.

## 1.0.0

Released: 2019-10-22

* Promote `v0.5.0` as stable release.
