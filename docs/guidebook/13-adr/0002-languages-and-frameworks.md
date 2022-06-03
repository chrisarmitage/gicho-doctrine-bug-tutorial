Gicho - Skeleton -> [Guidebook](../index.md) -> [Architectural Decision Records](index.md)

## Languages and Frameworks

|            |                |
| ---        | ---            |
| **Status** | Approved       |
| **Date**   | 2021-05-22     |
| **Driver** | Chris Armitage |

### Context

Modern web applications are built using a primary language and a framework. This needs to be decided before any coding work can commence.

### Decision

|                            |                     |
| ---                        |---------------------|
| **Language**               | PHP 8               |
| **Framework**              | chrisarmitage/gicho |
| **Deployment environment** | Docker / k8s        |

### Consequences

The choice of language and framework will allow us to use existing skills to decrease development time.

Using Docker will allow us to develop with Dev / Prod Parity, but will require investigation into deployment methods.
